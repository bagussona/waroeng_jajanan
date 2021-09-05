<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\CartController;
use App\Product;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        // dd(request()->all());

        $products = Product::orderBy('stock', 'DESC')->paginate(10);

        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;

        $scroll = true;

        return view('ecommerce.index', compact('products', 'scroll', 'licart'));

    }

    public function product(){

        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;

        $products = Product::orderBy('stock', 'DESC')->paginate(12);

        if(request()->q != ""){
            $products = Product::where('slug', 'LIKE', '%' . request()->q . '%' )->paginate(5)->setPath('');
        }

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('ecommerce.product', compact('products', 'categories', 'licart'));

    }

    public function categoryProduct($slug){
        // dd($slug);
        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;
        //JADI QUERYNYA ADALAH KITA CARI DULU KATEGORI BERDASARKAN SLUG, SETELAH DATANYA DITEMUKAN
        //MAKA SLUG AKAN MENGAMBIL DATA PRODUCT YANG BERELASI MENGGUNAKAN METHOD PRODUCT() YANG TELAH DIDEFINISIKAN PADA FILE CATEGORY.PHP SERTA DIURUTKAN BERDASARKAN CREATED_AT DAN DI-LOAD 12 DATA PER SEKALI LOAD
        $products = Product::where('category', $slug)->orderBy('created_at', 'DESC')->paginate(12);
        // dd($products);
        $categories = Category::orderBy('name', 'ASC')->get();

        //LOAD VIEW YANG SAMA YAKNI PRODUCT.BLADE.PHP KARENA TAMPILANNYA AKAN KITA BUAT SAMA JUGA
        return view('ecommerce.product', compact('products', 'licart', 'categories'));

    }

    public function show($slug){

    $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
    $licart = $getQty;
    //QUERY UNTUK MENGAMBIL SINGLE DATA BERDASARKAN SLUG-NYA
    $products = Product::where('slug', $slug)->first();

    //LOAD VIEW SHOW.BLADE.PHP DAN PASSING DATA PRODUCT
    return view('ecommerce.show', compact('products', 'licart'));


    }

    public function notificationCart(){

        if (Auth::guest()) {
            $notif = 0;
        } else{
            $uid = Auth::user()->id;
                $notif = Order::where('user_id', 'like', $uid)->count();

            }

        return $notif;

    }



}
