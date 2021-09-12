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

        $status = "Selesai";
        $total_kas = OrderHistory::where('status', $status)->get();

        // dd($subtotal);
        $duit_koperasi = collect($total_kas)->sum(function($q) {
            return $q['subtotal'];
        });

        $pekan1 = OrderHistory::whereBetween('created_at', ['2021-09-02', '2021-09-09'])->where('status', '=', 'Selesai')->get();
        $duit_pekan1 = collect($pekan1)->sum(function($q) {
            return $q['subtotal'];
        });
        $pekan2 = OrderHistory::whereBetween('created_at', ['2021-09-10', '2021-09-16'])->where('status', '=', 'Selesai')->get();
        $duit_pekan2 = collect($pekan2)->sum(function($q) {
            return $q['subtotal'];
        });
        $pekan3 = OrderHistory::whereBetween('created_at', ['2021-09-17', '2021-09-23'])->where('status', '=', 'Selesai')->get();
        $duit_pekan3 = collect($pekan3)->sum(function($q) {
            return $q['subtotal'];
        });
        $pekan4 = OrderHistory::whereBetween('created_at', ['2021-09-24', '2021-09-30'])->where('status', '=', 'Selesai')->get();
        $duit_pekan4 = collect($pekan4)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('home', compact('registered', 'product', 'omset_daily', 'transaction', 'ob', 'duit_koperasi', 'duit_pekan1', 'duit_pekan2', 'duit_pekan3', 'duit_pekan4'));
    }
}
