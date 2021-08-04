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
use Cookie;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CartController extends Controller
{

    public function addToCart(Request $request){

        $uid = Auth::user()->id;
        // dd($uid);
        // dd($request->product_id);
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $qty = $request->get('qty');
        // dd($qty);
        $data_produk = Product::find($request->product_id);
            // dd($data_produk->name);

            $image = $data_produk->image;
            $stock = $data_produk->stock;
            $name = $data_produk->name;
            $price = $data_produk->price;
            $subtotal = $qty * $price;
            // dd($subtotal);

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
        $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty->notificationCart();

        $uid = Auth::user()->id;
        //MENGAMBIL DATA
        $user = User::find($uid);
        $carts = Order::all();
        // //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });
        // //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
        return view('ecommerce.checkout', compact('carts', 'subtotal', 'user', 'licart'));

    }

    public function listCart(){

        $getQty = new FrontController();
        $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty->notificationCart();

        $carts = Order::all();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('ecommerce.cart', compact('carts', 'subtotal', 'licart'));

    }

    public function updateCart(Request $request){

    $req_qty = $request->qty;
    $id_product = $request->id;
    // dd($id_product);
    $uid = Auth::user()->id;

    Order::where('user_id', $uid)->where('id', $id_product)->update(['qty' => $req_qty]);


    $oldqty = Order::where('user_id', $uid)->where('id', $id_product)->get();
    $orders_name = $oldqty[0]['name'];
    $orders_price = $oldqty[0]['price'];
    $orders_qty = $oldqty[0]['qty']; //order qty

    $product = Product::where('name', $orders_name)->get();
    $product_stock = $product[0]['stock'];

    if ($req_qty > $orders_qty) {
        $addition = $req_qty - $orders_qty;
        $new_qty_greaterthan = $orders_qty + $addition;

        $addition_product_stock = $product_stock - $addition;
        Product::where('name', $orders_name)->update(['stock' => $addition_product_stock]);

        $subtotal_new_addition = $orders_price * $new_qty_greaterthan;
        Order::where('user_id', $uid)->where('id', $id_product)->update(['subtotal' => $subtotal_new_addition]);
    } else {
        $substraction = $orders_qty - $req_qty;

        $substraction_product_stock = $product_stock - $substraction;
        Product::where('name', $orders_name)->update(['stock' => $substraction_product_stock]);

        $subtotal_new_substraction = $orders_price * $substraction;
        Order::where('user_id', $uid)->where('id', $id_product)->update(['subtotal' => $subtotal_new_substraction]);
    }

    return redirect()->back();

    }

    public function destroyCart(Request $request){
        // dd($request->product_id);

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

        $email = $request->get('email');
        // //VALIDASI DATANYA
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);

        // //INISIASI DATABASE TRANSACTION
        // //DATABASE TRANSACTION BERFUNGSI UNTUK MEMASTIKAN SEMUA PROSES SUKSES UNTUK KEMUDIAN DI COMMIT AGAR DATA BENAR BENAR DISIMPAN, JIKA TERJADI ERROR MAKA KITA ROLLBACK AGAR DATANYA SELARAS
        DB::beginTransaction();
        try {
            //CHECK DATA CUSTOMER BERDASARKAN EMAIL
            $customer = User::where('email', $email)->first();

        //AMBIL DATA KERANJANG
        $carts = Order::all();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });


            //SIMPAN DATA ORDER
            $order = OrderHistory::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'customer_id' => $customer->id,
                'customer_name' => $request->get('name'),
                'customer_phone' => $request->nohape,
                'subtotal' => $subtotal
            ]);

            //LOOPING DATA DI CARTS
            foreach($carts as $row) {
                //AMBIL DATA PRODUK BERDASARKAN PRODUCT_ID
                $product = Product::find($row['id']);
                //SIMPAN DETAIL ORDER
                OrderDetail::create([
                    'order_id' => $order->id,
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'qty' => $row['qty']
                ]);
            }

            //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
            DB::commit();


            //KOSONGKAN DATA KERANJANG

            Order::where('user_id', $customer->id)->delete();

            //REDIRECT KE HALAMAN FINISH TRANSAKSI
            return redirect(route('front.finish_checkout', $order->invoice));
        } catch (\Exception $e) {
            //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
            DB::rollback();
            //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function checkoutFinish($invoice){

    $getQty = new FrontController();
    $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
    $licart = $getQty->notificationCart();

    // //AMBIL DATA PESANAN BERDASARKAN INVOICE
    $order = OrderHistory::where('invoice', $invoice)->first();
    $order_details = User::where('name', $order->customer_name)->get();

    return view('ecommerce.checkout_finish', compact('order', 'order_details', 'licart'));

    }

    public function notfound(){
        return view('ecommerce.notfound');
    }


}
