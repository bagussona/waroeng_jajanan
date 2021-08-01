<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderHistory;
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

            $name = $data_produk->name;
            $price = $data_produk->price;
            $subtotal = $qty * $price;
            // dd($subtotal);

            Order::create([
                'tanggal' => date('Y-m-d'),
                'keterangan' => 'Belum Bayar',
                'name' => $name,
                'qty' => $request->qty,
                'price' => $price,
                'subtotal' => $subtotal,
                'user_id' => $uid
            ]);

            OrderHistory::create([
                'tanggal' => date('Y-m-d'),
                'keterangan' => 'Belum Bayar',
                'name' => $name,
                'qty' => $request->qty,
                'price' => $price,
                'subtotal' => $subtotal,
                'user_id' => $uid
            ]);

            return redirect()->back()->with(['success' => 'Produk Ditambahkan ke Keranjang']);

    }


    public function checkout(){
    //QUERY UNTUK MENGAMBIL SEMUA DATA PROPINSI
    // $provinces = Province::orderBy('created_at', 'DESC')->get();
    // $getQty = $this->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
    // $jmlQty = $getQty;
    // // dd($jmlQty);
    // $carts = $this->getCarts(); //MENGAMBIL DATA CART
    // //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
    // $subtotal = collect($carts)->sum(function($q) {
    //     return $q['qty'] * $q['product_price'];
    // });
    // //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
    // return view('ecommerce.checkout', compact('provinces', 'carts', 'subtotal', 'jmlQty'));



    }

    public function listCart()
    {
        //MENGAMBIL DATA DARI COOKIE
        // $carts = json_decode(request()->cookie('dw-carts'), true);

        // $getQty = $this->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        // $jmlQty = $getQty;

        // //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        // $subtotal = collect($carts)->sum(function($q) {
        //     return $q['qty'] * $q['product_price']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        // });
        // //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
        // return view('ecommerce.cart', compact('carts', 'subtotal', 'jmlQty'));


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

    public function getCity()
    {
        // //QUERY UNTUK MENGAMBIL DATA KOTA / KABUPATEN BERDASARKAN PROVINCE_ID
        // $cities = City::where('province_id', request()->province_id)->get();
        // //KEMBALIKAN DATANYA DALAM BENTUK JSON
        // return response()->json(['status' => 'success', 'data' => $cities]);



    }

    public function getDistrict()
    {
        // //QUERY UNTUK MENGAMBIL DATA KECAMATAN BERDASARKAN CITY_ID
        // $districts = District::where('city_id', request()->city_id)->get();
        // //KEMUDIAN KEMBALIKAN DATANYA DALAM BENTUK JSON
        // return response()->json(['status' => 'success', 'data' => $districts]);



    }

    public function processCheckout(Request $request)
    {
        // //VALIDASI DATANYA
        // $this->validate($request, [
        //     'customer_name' => 'required|string|max:100',
        //     'customer_phone' => 'required',
        //     'email' => 'required|email',
        //     'customer_address' => 'required|string',
        //     'province_id' => 'required|exists:provinces,id',
        //     'city_id' => 'required|exists:cities,id',
        //     'district_id' => 'required|exists:districts,id'
        // ]);

        // //INISIASI DATABASE TRANSACTION
        // //DATABASE TRANSACTION BERFUNGSI UNTUK MEMASTIKAN SEMUA PROSES SUKSES UNTUK KEMUDIAN DI COMMIT AGAR DATA BENAR BENAR DISIMPAN, JIKA TERJADI ERROR MAKA KITA ROLLBACK AGAR DATANYA SELARAS
        // DB::beginTransaction();
        // try {
        //     //CHECK DATA CUSTOMER BERDASARKAN EMAIL
        //     $customer = Customer::where('email', $request->email)->first();
        //     //JIKA DIA TIDAK LOGIN DAN DATA CUSTOMERNYA ADA
        //     if (!auth()->check() && $customer) {
        //         //MAKA REDIRECT DAN TAMPILKAN INSTRUKSI UNTUK LOGIN
        //         return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
        //     }

        //     //AMBIL DATA KERANJANG
        //     $carts = $this->getCarts();
        //     //HITUNG SUBTOTAL BELANJAAN
        //     $subtotal = collect($carts)->sum(function($q) {
        //         return $q['qty'] * $q['product_price'];
        //     });

        //     //SIMPAN DATA CUSTOMER BARU
        //     $customer = Customer::create([
        //         'name' => $request->customer_name,
        //         'email' => $request->email,
        //         'phone_number' => $request->customer_phone,
        //         'address' => $request->customer_address,
        //         'district_id' => $request->district_id,
        //         'status' => false
        //     ]);

        //     //SIMPAN DATA ORDER
        //     $order = Order::create([
        //         'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
        //         'customer_id' => $customer->id,
        //         'customer_name' => $customer->name,
        //         'customer_phone' => $request->customer_phone,
        //         'customer_address' => $request->customer_address,
        //         'district_id' => $request->district_id,
        //         'subtotal' => $subtotal
        //     ]);

        //     //LOOPING DATA DI CARTS
        //     foreach($carts as $row) {
        //         //AMBIL DATA PRODUK BERDASARKAN PRODUCT_ID
        //         $product = Product::find($row['product_id']);
        //         //SIMPAN DETAIL ORDER
        //         OrderDetail::create([
        //             'order_id' => $order->id,
        //             'product_id' => $row['product_id'],
        //             'price' => $row['product_price'],
        //             'qty' => $row['qty'],
        //             'weight' => $product->weight
        //         ]);
        //     }

        //     //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
        //     DB::commit();

        //     $carts = [];
        //     //KOSONGKAN DATA KERANJANG DI COOKIE
        //     $cookie = cookie('dw-carts', json_encode($carts), 2880);
        //     //REDIRECT KE HALAMAN FINISH TRANSAKSI
        //     return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        // } catch (\Exception $e) {
        //     //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
        //     DB::rollback();
        //     //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
        //     return redirect()->back()->with(['error' => $e->getMessage()]);
        // }



    }

    public function checkoutFinish($invoice)
    {
    // //AMBIL DATA PESANAN BERDASARKAN INVOICE
    // $order = Order::with(['district.city'])->where('invoice', $invoice)->first();

    // $getQty = $this->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
    // $jmlQty = $getQty;

    // //LOAD VIEW checkout_finish.blade.php DAN PASSING DATA ORDER
    // return view('ecommerce.checkout_finish', compact('order', 'jmlQty'));



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
        // $nothing = "awkwkwkwk.803716578";
        return view('ecommerce.notfound');
    }


}
