<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(){

        $order_all = DB::table('order_details')->select('name as products', 'price', DB::raw('SUM(qty) as terjual, SUM(subtotal) as subtotal'))->groupBy('products', 'price')->havingRaw('SUM(qty) * price > 1', [2500])->paginate(5);
        // dd($order_all);

        $order_details = OrderDetail::all();
        $total = collect($order_details)->sum(function($q) {
            return $q['qty'] * $q['price'];
        });
        // dd($total);


        $selesai = 'Selesai';
        $order_history_selesai = OrderHistory::where('status', $selesai)->paginate(5);
        $proses = 'Proses';
        $order_history_proses = OrderHistory::where('status', $proses)->paginate(5);

        $order_history_proses_count = OrderHistory::where('status', $proses)->get();
        $order_history_selesai_count = OrderHistory::where('status', $selesai)->get();

        $total_proses = collect($order_history_proses_count)->sum(function($q) {
            return $q['subtotal'];
        });
        $total_selesai = collect($order_history_selesai_count)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('reports.daily', compact('order_all', 'total', 'total_selesai', 'total_proses', 'order_history_selesai', 'order_history_proses'));
    }

}
