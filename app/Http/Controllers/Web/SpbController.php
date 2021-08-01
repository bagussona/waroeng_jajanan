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

        $data_stock_warehouse = $data[0]['stock'];
        $stock_transfer = $request->get('datastore_stock');

        // dd($data[0]['supplier']['name']);
        Spb::create([
            'author' => Auth::user()->email,
            'name' => $request->get('datastore_name'),
            'slug' => $data[0]['slug'],
            'description' => $data[0]['description'],
            'supplier' => $data[0]['supplier']['name'],
            'category' => $data[0]['category']['name'],
            'stock' => $stock_transfer,
            'price' => $data[0]['price'],
            'image' => $data[0]['image']
            ]);

            $stock_warehouse = $data_stock_warehouse - $stock_transfer;
            ProductAdmin::where('name', $name)->update(['stock' => $stock_warehouse]);

            return redirect(route('datastore.index'))->with(['success' => 'Produk berhasil di BBK!' ]);

        }

        public function bbk(){
            // $databbk = Spb::all();
            $author = Auth::user()->email;

            // $bbk = [];
            $data_bbk = Spb::where('author', $author)->get();
            foreach ($data_bbk as $databbk) {

                    Product::create([
                        'name' => $databbk['name'],
                        'slug' => $databbk['slug'],
                        'description' => $databbk['description'],
                        'supplier' => $databbk['supplier'],
                        'category' => $databbk['category'],
                        'stock' => $databbk['stock'],
                        'price' => $databbk['price'],
                        'image' => $databbk['image'],
                    ]);

            }

            Spb::where('author', $author)->delete();

            return redirect(route('datastore.index'))->with(['success' => 'Berhasil di bbk!' ]);

        }

    public function destroy($id){
        // dd($id);
        $spb = Spb::where('id', $id)->get();
        // dd($spb[0]['name']);
        $bbk_name = $spb[0]['name'];
        $bbk_stock = $spb[0]['stock'];

        $product = ProductAdmin::where('name', $bbk_name)->get();
        // dd($product[0]['stock']);
        $stock_warehouse = $product[0]['stock'];

        $spb_stock_cancel = $stock_warehouse + $bbk_stock;
        ProductAdmin::where('name', $bbk_name)->update(['stock' => $spb_stock_cancel]);

        Spb::where('id', $id)->delete();

        return redirect(route('datastore.index'))->with(['success' => 'Spb berhasil dihapus!' ]);
    }
}
