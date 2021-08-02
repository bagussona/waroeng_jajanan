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

    private function getCarts()
    {
        // $carts = json_decode(request()->cookie('dw-carts'), true);
        // // $carts = $this->getCarts();
        // $carts = $carts != '' ? $carts:[];
        // // dd($carts);
        // return $carts;



    }

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
        $uid = Auth::user()->id;
        //MENGAMBIL DATA
        $user = User::find($uid);
        $carts = Order::all();
        // //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });
        // //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
        return view('ecommerce.checkout', compact('carts', 'subtotal', 'user'));

    }

    public function listCart()
    {

        $carts = Order::all();
        $subtotal = collect($carts)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('ecommerce.cart', compact('carts', 'subtotal'));


    }

    public function updateCart(Request $request)
    {
    // //AMBIL DATA DARI COOKIE
    // $carts = json_decode(request()->cookie('dw-carts'), true);
    // //KEMUDIAN LOOPING DATA PRODUCT_ID, KARENA NAMENYA ARRAY PADA VIEW SEBELUMNYA
    // //MAKA DATA YANG DITERIMA ADALAH ARRAY SEHINGGA BISA DI-LOOPING
    // foreach ($request->product_id as $key => $row) {
    //     //DI CHECK, JIKA QTY DENGAN KEY YANG SAMA DENGAN PRODUCT_ID = 0
    //     if ($request->qty[$key] == 0) {
    //         //MAKA DATA TERSEBUT DIHAPUS DARI ARRAY
    //         unset($carts[$row]);
    //     } else {
    //         //SELAIN ITU MAKA AKAN DIPERBAHARUI
    //         $carts[$row]['qty'] = $request->qty[$key];
    //     }
    // }
    // //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
    // $cookie = cookie('dw-carts', json_encode($carts), 2880);
    // //DAN STORE KE BROWSER.
    // return redirect()->back()->cookie($cookie);



    }

    public function processCheckout(Request $request)
    {
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

    public function checkoutFinish($invoice)
    {
    // //AMBIL DATA PESANAN BERDASARKAN INVOICE
    $order = OrderHistory::where('invoice', $invoice)->first();
    $order_details = User::where('name', $order->customer_name)->get();

    // $getQty = $this->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
    // $jmlQty = $getQty;

    // //LOAD VIEW checkout_finish.blade.php DAN PASSING DATA ORDER
    return view('ecommerce.checkout_finish', compact('order', 'order_details'));



    }

    public function showQtyCart(){
        // $carts = $this->getCarts(); //MENGAMBIL DATA CART
        // //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        // // dd($carts);
        // $arr = 0;
        // foreach ($carts as $c){
        // $arr = $arr + $c['qty'];
        // }
        // return $arr;



    }

    public function notfound(){
        return view('ecommerce.notfound');
    }


}
