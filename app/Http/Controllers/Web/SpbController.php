<?php

namespace App\Http\Controllers\Web;

use App\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAdmin;
use App\Spb;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpbController extends Controller
{

    public function index(){
        $data = ProductAdmin::all();

        $spb = Spb::all();

        return view('datastore.index', compact('spb', 'data'));

    }

    public function store(Request $request){
        // dd($request->datastore_name);
        $name = $request->datastore_name;

        $data = ProductAdmin::where('name', $name)->get();

        // dd($data[0]['supplier']['name']);
        Spb::create([
            'author' => Auth::user()->email,
            'name' => $request->get('datastore_name'),
            'description' => $data[0]['description'],
            'supplier' => $data[0]['supplier']['name'],
            'category' => $data[0]['category']['name'],
            'stock' => $request->get('datastore_stock'),
            'price' => $data[0]['price'],
            'image' => $data[0]['image']
            ]);


            return redirect(route('datastore.index'))->with(['success' => 'Produk berhasil di BBK!' ]);

        }

        public function bbk(){
            Spb::all();

            // $stock_display = $request->datastore_stock;
            // $stock_gudang = $data[0]['stock'];

            // $stock_akhir = $stock_gudang - $stock_display;
        // ProductAdmin::where('name', $name)->update('stock', $stock_akhir);

    }

    public function destroy($id){
        // dd($id);

        $spb = Spb::where('id', $id)->delete();

        return redirect(route('datastore.index'))->with(['success' => 'Spb berhasil dihapus!' ]);
    }
}
