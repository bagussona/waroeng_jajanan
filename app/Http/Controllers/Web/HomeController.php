<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderHistory;
use App\ProductAdmin;
use App\User;

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

        return view('home', compact('registered', 'product', 'omset_daily'));
    }
}
