<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\OrderHistory;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(){

        $current_date = date('Y-m-d');

        $order_all = DB::table('order_details')->select('name as products', 'price', DB::raw('SUM(qty) as terjual, SUM(subtotal) as subtotal'))->groupBy('products', 'price')->havingRaw('SUM(qty) * price > 1', [2500])->where('created_at', 'LIKE', '%' . $current_date . '%')->paginate(5);
        // dd($order_all);

        $order_details = OrderDetail::where('created_at', 'LIKE', '%' . $current_date . '%')->get();
        $total = collect($order_details)->sum(function($q) {
            return $q['qty'] * $q['price'];
        });
        // dd($total);


        $selesai = 'Selesai';
        $order_history_selesai = OrderHistory::where('status', $selesai)->where('created_at', 'LIKE', '%' . $current_date . '%')->paginate(5);
        $proses = 'Proses';
        $order_history_proses = OrderHistory::where('status', $proses)->where('created_at', 'LIKE', '%' . $current_date . '%')->paginate(5);

        $order_history_proses_count = OrderHistory::where('status', $proses)->where('created_at', 'LIKE', '%' . $current_date . '%')->get();
        $order_history_selesai_count = OrderHistory::where('status', $selesai)->where('created_at', 'LIKE', '%' . $current_date . '%')->get();

        $total_proses = collect($order_history_proses_count)->sum(function($q) {
            return $q['subtotal'];
        });
        $total_selesai = collect($order_history_selesai_count)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('reports.daily', compact('order_all', 'total', 'total_selesai', 'total_proses', 'order_history_selesai', 'order_history_proses'));
    }

    public function createPDF(){
        $current_date = date('Y-m-d');

        $order_all = DB::table('order_details')->select('name as products', 'price', DB::raw('SUM(qty) as terjual, SUM(subtotal) as subtotal'))->groupBy('products', 'price')->havingRaw('SUM(qty) * price > 1', [2500])->where('created_at', 'LIKE', '%' . $current_date . '%')->paginate(5);
        // dd($order_all);

        $order_details = OrderDetail::where('created_at', 'LIKE', '%' . $current_date . '%')->get();
        $total = collect($order_details)->sum(function($q) {
            return $q['qty'] * $q['price'];
        });
        // dd($total);


        $selesai = 'Selesai';
        $order_history_selesai = OrderHistory::where('status', $selesai)->where('created_at', 'LIKE', '%' . $current_date . '%')->paginate(5);
        $proses = 'Proses';
        $order_history_proses = OrderHistory::where('status', $proses)->where('created_at', 'LIKE', '%' . $current_date . '%')->paginate(5);

        $order_history_proses_count = OrderHistory::where('status', $proses)->where('created_at', 'LIKE', '%' . $current_date . '%')->get();
        $order_history_selesai_count = OrderHistory::where('status', $selesai)->where('created_at', 'LIKE', '%' . $current_date . '%')->get();

        $total_proses = collect($order_history_proses_count)->sum(function($q) {
            return $q['subtotal'];
        });
        $total_selesai = collect($order_history_selesai_count)->sum(function($q) {
            return $q['subtotal'];
        });

        // view()->share('order_all', $order_all);

        // $dompdf = new Dompdf();
        $dompdf = PDF::loadView('reports.pdf_daily', compact('order_all', 'total', 'total_selesai', 'total_proses', 'order_history_selesai', 'order_history_proses'));

        return $dompdf->download('pdf_daily.pdf');

    }

}
