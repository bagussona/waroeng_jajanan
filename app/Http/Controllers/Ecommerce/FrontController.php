<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){

        $products = Product::orderBy('stock', 'DESC')->where('stock', '>=', 1)->paginate(10);

        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;

        $scroll = true;

        return view('ecommerce.index', compact('products', 'scroll', 'licart'));

    }

    public function product(){

        $products = Product::orderBy('stock', 'DESC')->where('stock', '>=', 1)->paginate(12);

        if(request()->q != ""){
            $products = Product::where('slug', 'LIKE', '%' . request()->q . '%' )->paginate(12)->setPath('');
        }

        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('ecommerce.product', compact('products', 'categories', 'licart'));

    }

    public function categoryProduct($slug){

        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;

        $products = Product::where('category', $slug)->orderBy('created_at', 'DESC')->paginate(12);

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('ecommerce.product', compact('products', 'licart', 'categories'));

    }

    public function show($slug){

        $getQty = $this->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty;

        $products = Product::where('slug', $slug)->first();

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
