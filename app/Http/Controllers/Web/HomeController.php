<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderHistory;
use App\ProductAdmin;
use App\User;
use App\Http\Controllers\UserProfile\UserProfileController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $registered = User::all()->count();
        $product = ProductAdmin::all()->count();
        // $subtotal = OrderHistory::all();
        $current_date = date('Y-m-d');
        $subtotal = OrderHistory::where('created_at', 'LIKE', '%' . $current_date . '%')->get();

        // dd($subtotal);
        $omset_daily = collect($subtotal)->sum(function($q) {
            return $q['subtotal'];
        });

        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        $transaction = OrderHistory::where('created_at', 'LIKE', '%' . $current_date . '%')->count();

        return view('home', compact('registered', 'product', 'omset_daily', 'transaction', 'ob'));
    }
}
