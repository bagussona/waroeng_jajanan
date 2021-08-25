<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\OrderHistory;
use App\Report;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function dummy(){

        $current_date = date('Y-m-d');

        $order_all = DB::table('order_details')->select('name as products', 'price', DB::raw('SUM(qty) as terjual, SUM(subtotal) as subtotal'))->groupBy('products', 'price')->havingRaw('SUM(qty) * price > 1', [2500])->where('created_at', 'LIKE', '%' . $current_date . '%')->get();
        // dd($order_all);

        $total = collect($order_all)->sum(function($q) {
            return $q->terjual * $q->price;
        });
        // dd($total);


        $selesai = 'Selesai';
        $order_history_selesai = OrderHistory::where('status', $selesai)->where('created_at', 'LIKE', '%' . $current_date . '%')->get();
        $proses = 'Proses';
        $order_history_proses = OrderHistory::where('status', $proses)->where('created_at', 'LIKE', '%' . $current_date . '%')->get();

        $total_proses = collect($order_history_proses)->sum(function($q) {
            return $q['subtotal'];
        });
        $total_selesai = collect($order_history_selesai)->sum(function($q) {
            return $q['subtotal'];
        });

        return view('reports.pdf_daily', compact('order_all', 'total', 'total_selesai', 'total_proses', 'order_history_selesai', 'order_history_proses'));
    }

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

    public function inquiry(){

        // dd(request()->all());

        // dd($request);
        $customer_name = DB::table('order_histories')->select('customer_name')->distinct()->get();
        $product_order = DB::table('order_details')->select('name')->distinct()->get();
        $status_order = DB::table('order_histories')->select('status')->distinct()->get();

                //converting
                $var0 = request()->inquiry_name;
                $var1 = request()->datepickerfrom;
                $var2 = request()->datepickerto;
                $var3 = request()->inquiry_invoice_string;
                $var4 = request()->inquiry_invoice_date;
                $var5 = request()->inquiry_type_product;
                $var6 = request()->inquiry_status;
                $var7 = request()->invoice_loop;

                // dd($var0, $var1, $var2, $var3, $var4, $var5);

                //result $request
                $new_datepickerfrom = date('Y-m-d', strtotime($var1));
                $new_datepickerto = date('Y-m-d', strtotime($var2));
                $new_invoice = $var3 . "-" . $var4;
                $new_customer_name = $var0;
                $new_status = $var6;
                $new_product = $var5;
                $periode = $new_datepickerfrom . " s/d " . $new_datepickerto;

                // dd($new_customer_name, $new_datepickerfrom, $new_datepickerto, $new_invoice, $new_product, $new_status);

                if ($new_invoice !== '') {
                    $result_invoice = OrderHistory::where('invoice', 'LIKE', '%' . $new_invoice . '%')->get();
                    // dd($result_invoice);
                }

                $result = OrderHistory::whereBetween('created_at', [$new_datepickerfrom, $new_datepickerto])
                ->where('customer_name', 'LIKE', '%' . $new_customer_name . '%')
                ->where('status', 'LIKE', '%' . $new_status . '%')
                ->paginate(1);

                // dd($result);
                $result->appends(request()->all())->links();
                $snacks = OrderDetail::where('order_id', $var7)->get();

        return view('reports.inquiry', compact('customer_name', 'product_order', 'status_order', 'result', 'result_invoice', 'snacks', 'periode'));
    }

    public function inquiryPost(Request $request){
        // dd($request);

        //converting
        $var1 = $request->get('datepickerfrom');
        $var2 = $request->get('datepickerto');
        $var3 = $request->get('inquiry_invoice_string');
        $var4 = $request->get('inquiry_invoice_date');
        $var5 = $request->get('invoice_loop');

        //result $request
        $new_datepickerfrom = date('Y-m-d', strtotime($var1));
        $new_datepickerto = date('Y-m-d', strtotime($var2));
        $new_invoice = $var3 . "-" . $var4;
        $new_customer_name = $request->get('inquiry_name');
        $new_status = $request->get('inquiry_status');
        $new_product = $request->get('inquiry_type_product');


        if ($new_invoice !== '') {
            $result_invoice = OrderHistory::where('invoice', 'LIKE', '%' . $new_invoice . '%')->get();
            // dd($result_invoice);
        }

        $result = OrderHistory::whereBetween('created_at', [$new_datepickerfrom, $new_datepickerto])
        ->where('customer_name', 'LIKE', '%' . $new_customer_name . '%')
        ->where('status', 'LIKE', '%' . $new_status . '%')
        ->paginate(1);

        // dd($result);
        $snacks = OrderDetail::where('order_id', $var5)->get();

        // dd($result, $result_invoice);

        // dd($new_datepickerfrom, $new_datepickerto, $new_invoice, $new_customer_name, $new_status, $new_product);
    }

}
