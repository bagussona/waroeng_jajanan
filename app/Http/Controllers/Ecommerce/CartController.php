<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderDetail;
use App\OrderHistory;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function addToCart(Request $request){

        $uid = Auth::user()->id;

        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $qty = $request->get('qty');

        $data_produk = Product::find($request->product_id);

        if($qty > $data_produk->stock) {
            return redirect()->back()->withErrors('Jumlah yang dimasukkan melebihi stok');
        }

            $image = $data_produk->image;
            $stock = $data_produk->stock;
            $name = $data_produk->name;
            $price = $data_produk->price;
            $subtotal = $qty * $price;

            Order::create([
                'tanggal' => date('Y-m-d'),
                'image' => $image,
                'name' => $name,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
                'user_id' => $uid
            ]);

            $stock_dicart = $stock - $qty;

                Product::find($request->product_id)->update(['stock' => $stock_dicart]);

        return redirect()->back()->with(['success' => 'Produk Ditambahkan ke Keranjang']);

    }


    public function checkout(){

        $getQty = new FrontController();
        $getQty->notificationCart();
        $licart = $getQty->notificationCart();

        $uid = Auth::user()->id;
        $user = User::find($uid);
        $carts = Order::where('user_id', $uid)->get();

        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('ecommerce.checkout', compact('carts', 'subtotal', 'user', 'licart'));

    }

    public function listCart(){

        $uid = Auth::user()->id;

        $getQty = new FrontController();
        $getQty->notificationCart();
        $licart = $getQty->notificationCart();

        $carts = Order::where('user_id', $uid)->get();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('ecommerce.cart', compact('carts', 'subtotal', 'licart'));

    }

    public function updateCart(Request $request){

        $uid = Auth::user()->id;

        $order = Order::where('user_id', $uid)->where('id', $request->id)->get();
        $order_name = $order[0]['name'];

        $product = Product::where('name', $order_name)->get();

        $pengembalian_stock = $product[0]['stock'] + $order[0]['qty'];
        $subtotal = $request->qty * $order[0]['price'];

        Product::where('name', $order_name)->update(['stock' => $pengembalian_stock]);

        Order::where('user_id', $uid)->where('id', $request->id)->update(['qty' => $request->qty, 'subtotal' => $subtotal]);

        $qty = Order::where('user_id', $uid)->where('id', $request->id)->get();
        $stock = Product::where('name', $order_name)->get();

        $updated_stock = $stock[0]['stock'] - $qty[0]['qty'];

        Product::where('name', $order_name)->update(['stock' => $updated_stock]);

        return redirect()->back();

    }

    public function destroyCart(Request $request){

        $uid = Auth::user()->id;
        $id_order = $request->product_id;

        $order = Order::where('id', $id_order)->get();
        $order_name = $order[0]['name'];
        $order_qty = $order[0]['qty'];

        $product = Product::where('name', $order_name)->get();
        $product_stock = $product[0]['stock'];

        $pengembalian_stock = $product_stock + $order_qty;

        Product::where('name', $order_name)->update(['stock' => $pengembalian_stock]);

        Order::where('id', $id_order)->where('user_id', $uid)->delete();

        return redirect()->back();

    }

    public function admindestroyCart(Request $request){

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

    public function processCheckout(Request $request){

        $uid = Auth::user()->id;

        DB::beginTransaction();
        try {

            $carts = Order::where('user_id', $uid)->get();

            $subtotal = collect($carts)->sum(function($q) {
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

            foreach($carts as $row) {
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

            return redirect(route('front.finish_checkout', $order->invoice));

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function checkoutFinish($invoice){

        $getQty = new FrontController();
        $getQty->notificationCart();
        $licart = $getQty->notificationCart();

        $order = OrderHistory::where('invoice', $invoice)->first();
        $order_details = User::where('id', Auth::user()->id)->first();

        return view('ecommerce.checkout_finish', compact('order', 'order_details', 'licart'));

    }

    public function notfound(){

        return view('ecommerce.notfound');

    }

}
