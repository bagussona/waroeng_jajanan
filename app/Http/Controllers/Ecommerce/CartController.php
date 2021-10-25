<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderDetail;
use App\OrderHistory;
use App\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $uid = Auth::user()->id;

        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ], [
            'qty.integer' => 'Jumlah yang dimasukkan harus angka'
        ]);

        $qty = $request->get('qty');

        $product = Product::find($request->product_id);

        if ($qty > $product->stock) {
            return redirect()->back()->withError('Jumlah yang dimasukkan melebihi stok');
        }

        DB::beginTransaction();
        try {
            Order::create([
                'tanggal' => date('Y-m-d'),
                'image' => $product->image,
                'name' => $product->name,
                'qty' => $qty,
                'price' => $product->price,
                'subtotal' => $qty * $product->price,
                'user_id' => $uid
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withError('Terjadi kesalahan');
        }

        Product::find($request->product_id)->update(['stock' => $product->stock - $qty]);

        return redirect()->back()->withSuccess('Produk ditambahkan ke keranjang');
    }


    public function checkout()
    {
        $getQty = new FrontController();
        $getQty->notificationCart();
        $licart = $getQty->notificationCart();

        $uid = Auth::user()->id;
        $user = User::find($uid);
        $carts = Order::where('user_id', $uid)->get();

        $subtotal = collect($carts)->sum(function ($q) {
            return $q['subtotal'];
        });

        return view('ecommerce.checkout', compact('carts', 'subtotal', 'user', 'licart'));
    }

    public function listCart()
    {
        $uid = Auth::user()->id;

        $getQty = new FrontController();
        $getQty->notificationCart();
        $licart = $getQty->notificationCart();

        $carts = Order::where('user_id', $uid)->get();
        $products = Product::select('name', 'stock')->get();
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['subtotal'];
        });

        return view('ecommerce.cart', compact('carts', 'products', 'subtotal', 'licart'));
    }

    public function updateCart(Request $request)
    {
        $uid = Auth::user()->id;

        $order = Order::where('user_id', $uid)->where('id', $request->id)->firstOrFail();

        $product = Product::where('name', $order->name)->firstOrFail();

        if($request->qty > $product->stock) {
            return redirect()->back()->withError('Jumlah yang dimasukkan melebihi stok');
        }

        DB::beginTransaction();
        try {
            Product::where('name', $order->name)->update(['stock' => ($product->stock + $order->qty) - $request->qty]);
            Order::where('user_id', $uid)->where('id', $request->id)->update(['qty' => $request->qty, 'subtotal' => $request->qty * $order->price]);

            DB::commit();
        } catch(Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }

        return redirect()->back()->withSuccess('Keranjang berhasil di ubah');
    }

    public function destroyCart(Request $request)
    {
        $uid = Auth::user()->id;

        $order = Order::where('id', $request->order_id)->firstOrFail();

        $product = Product::where('name', $order->name)->firstOrFail();

        Product::where('name', $order->name)->update(['stock' => $product->stock + $order->qty]);

        DB::beginTransaction();
        try {
            $order = Order::where('id', $request->order_id)->where('user_id', $uid)->delete();
            if(!$order) {
                return redirect()->back()->withErrors('ada yang salah');
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors('Terjadi kesalahan');
        }

        return redirect()->back()->withSuccess('Berhasil menghapus barang dari keranjang');
    }

    public function admindestroyCart(Request $request)
    {
        $id_order = $request->product_id;

        $order = Order::where('id', $id_order)->get();
        $order_name = $order[0]['name'];
        $order_qty = $order[0]['qty'];

        $product = Product::where('name', $order_name)->get();
        $product_stock = $product[0]['stock'];

        $pengembalian_stock = $product_stock + $order_qty;

        Product::where('name', $order_name)->update(['stock' => $pengembalian_stock]);

        Order::where('id', $id_order)->delete();

        return redirect()->back();
    }

    public function processCheckout(Request $request)
    {
        $uid = Auth::user()->id;

        DB::beginTransaction();
        try {
            $carts = Order::where('user_id', $uid)->get();
            if ($carts->isEmpty()) {
                return redirect()->back()->withErrors('Belum memesan apapun');
            }

            $subtotal = collect($carts)->sum(function ($q) {
                return $q['subtotal'];
            });

            $order = OrderHistory::create([
                'invoice' => Str::random(4) . '-' . time(),
                'customer_id' => Auth::user()->id,
                'customer_name' => $request->name,
                'customer_phone' => $request->nohape,
                'subtotal' => $subtotal,
                'telah_bayar' => 0,
                'sisa_hutang' => $subtotal,
                'status' => 'Proses',
                'operator' => 'unauthorized'
            ]);

            foreach ($carts as $row) {
                $stl = $row['qty'] * $row['price'];

                OrderDetail::create([
                    'order_id' => $order->invoice,
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'qty' => $row['qty'],
                    'subtotal' => $stl
                ]);
            }

            DB::commit();

            Order::where('user_id', $uid)->delete();
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors('Terjadi kesalahan');
        }

        return redirect(route('front.finish_checkout', $order->invoice));
    }

    public function checkoutFinish($invoice)
    {
        $getQty = new FrontController();
        $getQty->notificationCart();
        $licart = $getQty->notificationCart();

        $order = OrderHistory::where('invoice', $invoice)->first();
        $order_details = User::where('id', Auth::user()->id)->first();

        return view('ecommerce.checkout_finish', compact('order', 'order_details', 'licart'));
    }

    public function notfound()
    {
        return view('ecommerce.notfound');
    }
}
