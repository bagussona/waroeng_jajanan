<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\CartController;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);

        $scroll = true;

        return view('ecommerce.index', compact('products', 'scroll'));

    }

    public function product(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        // $categories = Category
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('ecommerce.product', compact('products', 'categories'));

    }

    public function categoryProduct($slug)
    {
       //JADI QUERYNYA ADALAH KITA CARI DULU KATEGORI BERDASARKAN SLUG, SETELAH DATANYA DITEMUKAN
       //MAKA SLUG AKAN MENGAMBIL DATA PRODUCT YANG BERELASI MENGGUNAKAN METHOD PRODUCT() YANG TELAH DIDEFINISIKAN PADA FILE CATEGORY.PHP SERTA DIURUTKAN BERDASARKAN CREATED_AT DAN DI-LOAD 12 DATA PER SEKALI LOAD
       $products = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);

        //LOAD VIEW YANG SAMA YAKNI PRODUCT.BLADE.PHP KARENA TAMPILANNYA AKAN KITA BUAT SAMA JUGA
        return view('ecommerce.product', compact('products'));



    }

    public function show($slug)
    {
    // //QUERY UNTUK MENGAMBIL SINGLE DATA BERDASARKAN SLUG-NYA
    $products = Product::where('slug', $slug)->first();

    // //LOAD VIEW SHOW.BLADE.PHP DAN PASSING DATA PRODUCT
    return view('ecommerce.show', compact('products'));


    }



}
