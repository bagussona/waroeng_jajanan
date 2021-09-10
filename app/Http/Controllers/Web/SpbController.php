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
use App\Http\Controllers\UserProfile\UserProfileController;

class SpbController extends Controller
{

    public function index(){

        $data = ProductAdmin::all();

        $author = Auth::user()->email;
        $spb = Spb::where('keterangan', 'BBK')->where('author', $author)->get();

        $spb_admin = Spb::all();

        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        return view('datastore.index', compact('spb', 'data', 'spb_admin', 'ob'));

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
            'keterangan' => 'BBK',
            'name' => $request->get('datastore_name'),
            'slug' => $data[0]['slug'],
            'description' => $data[0]['description'],
            'supplier' => $data[0]['supplier']['name'],
            'category' => $data[0]['category']['slug'],
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
            $data_bbk = Spb::where('keterangan', 'BBK')->where('author', $author)->get();
            foreach ($data_bbk as $databbk) {
                // dd($databbk['stock']);
                $bbk_stock = $databbk['stock'];
                $bbk_name = $databbk['name'];

                if (Product::where('name', $bbk_name)->count() > 0) {

                    $product = Product::where('name', $bbk_name)->get();
                    $product_stock = $product[0]['stock'];
                    // dd($product_stock);

                    $store_stock_new = $product_stock + $bbk_stock;
                    Product::where('name', $bbk_name)->update([
                        'stock' => $store_stock_new,
                    ]);
                } else {
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

            }

            Spb::where('author', $author)->delete();

            return redirect(route('datastore.index'))->with(['success' => 'Berhasil di bbk!' ]);

        }

        public function bbmindex(){

            $data = ProductAdmin::all();

            $author = Auth::user()->email;

            $spb = Spb::where('keterangan', 'BBM')->where('author', $author)->get();
            // dd($spb);

            $spb_admin = Spb::all();
            // dd($spb_admin);

            $getQty = new UserProfileController();
            $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
            $ob = $getQty->orderanCount();

            return view('datastore.bbmindex', compact('spb', 'data', 'spb_admin', 'ob'));

        }

        public function bbm(Request $request){
            // dd($request->datastore_name);
            $name = $request->datastore_name;

            $data = ProductAdmin::where('name', $name)->get();
            // dd($data->price);

            // $data_stock_warehouse = $data[0]['stock'];
            $stock_transfer = $request->get('datastore_stock');

            // dd($data[0]['supplier']['name']);
            Spb::create([
                'author' => Auth::user()->email,
                'keterangan' => 'BBM',
                'name' => $request->get('datastore_name'),
                'slug' => $data->slug,
                'description' => $data->description,
                'supplier' => $data->supplier->name,
                'category' => $data->category->name,
                'stock' => $stock_transfer,
                'price' => $data->price,
                'image' => $data->image
            ]);

            return redirect(route('datastore.bbmindex'))->with(['success' => 'Produk berhasil di BBM!' ]);

        }

        public function bbmWarehouse(){
            // $databbk = Spb::all();
            $author = Auth::user()->email;

            $data_bbm = Spb::where('keterangan', 'BBM')->where('author', $author)->get();
            $bbm = [];
            foreach ($data_bbm as $databbm) {
                // dd($databbm['stock']);
                $bbm[] = [
                    'bbm_name' => $databbm['name'],
                    'bbm_stock' => $databbm['stock']
                ];
            }

            foreach ($bbm as $value) {
                // dd($value);
                $bbm_name = $value['bbm_name'];
                $bbm_stock = $value['bbm_stock'];

                $data_stock_warehouse = ProductAdmin::where('name', $bbm_name)->get();

                $store_stock = $data_stock_warehouse[0]['stock'];
                // dd($store_stock);

                $store_stock_new = $store_stock + $bbm_stock;
                // dd($store_stock_new);

                ProductAdmin::where('name', $bbm_name)->update(['stock' => $store_stock_new]);

                }

            Spb::where('author', $author)->delete();

            return redirect(route('datastore.bbmindex'))->with(['success' => 'Berhasil di bbm!' ]);

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

    public function destroyBBM($id){
        // dd($id);

        Spb::where('id', $id)->delete();

        return redirect(route('datastore.bbmindex'))->with(['success' => 'Spb berhasil dihapus!' ]);
    }
}
