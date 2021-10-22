<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use App\Order;
use App\Product;
use App\OrderDetail;
use App\OrderHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class CartController extends Controller
{
    public function show()
    {
        $orders = Order::where('user_id', JWTAuth::parseToken()->authenticate()->id)->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Data orderan berhasil diambil',
            'data' => $orders
        ]);
    }

    public function addToCart(Request $request)
    {
        $uid = JWTAuth::parseToken()->authenticate()->id;

        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $qty = $request->get('qty');

        $product = Product::findOrFail($request->product_id);

        if ($qty > $product->stock) {
            return response()->json([
                'status' => 'failed',
                'msg' => 'Jumlah orderan yang diinginkan melebihi jumlah produk yang tersedia',
            ], 400);
        }

        DB::beginTransaction();
        try {
            Order::create([
                'tanggal' => date('Y-m-d'),
                'image' => $product->image,
                'name' => $product->name,
                'qty' => $qty,
                'price' => $product->price,
                'subtotal' => $product->price * $qty,
                'user_id' => $uid
            ]);

            Product::findOrFail($request->product_id)->update([
                'stock' => $product->stock - $qty
            ]);

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'msg' => 'Produk gagal ditambahkan ke keranjang',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Produk berhasil ditambahkan ke keranjang',
        ], 201);
    }

    public function updateCart(Request $request, $order_id)
    {
        $uid = JWTAuth::parseToken()->authenticate()->id;
        $qty = $request->qty;

        $order = Order::where('user_id', $uid)->where('id', $order_id)->firstOrFail();
        $product = Product::where('name', $order->name)->firstOrFail();

        // JIKA QTY > QTY PRODUK MAKA DIBERI RESPON
        if ($qty > $product->stock) {
            return response()->json([
                'status' => 'failed',
                'msg' => 'Jumlah orderan yang diinginkan melebihi jumlah produk yang tersedia',
            ], 400);
        }

        DB::beginTransaction();
        try {
            Order::where('user_id', $uid)->where('id', $order_id)->update([
                'qty' => $qty,
                'subtotal' => $qty * $order->price
            ]);

            Product::where('name', $order->name)->update([
                'stock' => ($product->stock + $order->qty) - $qty
            ]);

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'msg' => 'Jumlah orderan produk gagal diubah',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Jumlah orderan produk berhasil diubah',
        ]);
    }


    public function processCheckout()
    {
        // CUSTOMER DARI USER YANG LOGIN SAAT INI
        $customer = JWTAuth::parseToken()->authenticate();

        DB::beginTransaction();
        try {
            $carts = Order::where('user_id', $customer->id)->get();

            $subtotal = collect($carts)->sum(function ($q) {
                return $q['subtotal'];
            });

            $order = OrderHistory::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'customer_id' => $customer->id,
                //'customer_name' => $request->get('name'),
                'customer_name' => $customer->name,
                //'customer_phone' => $request->nohape,
                'customer_phone' => $customer->nohape,
                'subtotal' => $subtotal,
                'telah_bayar' => 0,
                'sisa_hutang' => $subtotal,
                'status' => 'Proses',
                'operator' => 'unauthorized'
            ]);

            foreach ($carts as $cart) {
                // SUBTOTAL UNTUK DETAIL ORDER
                $stl = $cart['qty'] * $cart['price'];

                OrderDetail::create([
                    'order_id' => $order->invoice,
                    'name' => $cart['name'],
                    'price' => $cart['price'],
                    'qty' => $cart['qty'],
                    'subtotal' => $stl
                ]);
            }

            Order::where('user_id', $customer->id)->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'failed',
                'msg' => 'Check out orderan gagal',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Check out orderan berhasil',
        ]);
    }

    public function checkoutFinish($invoice)
    {
        $order_details = OrderHistory::where('invoice', $invoice)->firstOrFail();

        return response()->json([
            'status' => 'success',
            'msg' => 'Detail order berhasil diambil',
            'data' => $order_details
        ]);
    }

    public function destroyCart($order_id)
    {
        $uid = JWTAuth::parseToken()->authenticate()->id;

        $order = Order::where('user_id', $uid)->where('id', $order_id);

        $product = Product::where('name', (clone $order)->firstOrFail()->name)->firstOrFail();

        DB::beginTransaction();
        try {
            Product::where('name', (clone $order)->firstOrFail()->name)->update([
                'stock' => $product->stock + (clone $order)->firstOrFail()->qty
            ]);

            (clone $order)->delete();

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'msg' => 'Orderan gagal dihapus dari keranjang',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Orderan berhasil dihapus dari keranjang',
        ]);
    }
}
