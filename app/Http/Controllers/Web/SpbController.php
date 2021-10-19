<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserProfile\UserProfileController;
use App\SpbCart;

class SpbController extends Controller
{

    public function index(){

        $data = ProductAdmin::all();

        $author = Auth::user()->email;
        $spb = SpbCart::where('keterangan', 'BBK')->where('author', $author)->get();

        $spb_admin = SpbCart::all();

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
        SpbCart::create([
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

            $author = Auth::user()->email;

            $data_bbk = SpbCart::where('keterangan', 'BBK')->where('author', $author)->get();
            foreach ($data_bbk as $databbk) {

                $bbk_stock = $databbk['stock'];
                $bbk_name = $databbk['name'];

                if (Product::where('name', $bbk_name)->count() > 0) {

                    $product = Product::where('name', $bbk_name)->get();
                    $product_stock = $product[0]['stock'];

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

            SpbCart::where('author', $author)->delete();

            return redirect(route('datastore.index'))->with(['success' => 'Berhasil di bbk!' ]);

        }

        public function bbmindex(){

            $data = ProductAdmin::all();

            $author = Auth::user()->email;

            $spb = SpbCart::where('keterangan', 'BBM')->where('author', $author)->get();
            // dd($spb);

            $spb_admin = SpbCart::all();
            // dd($spb_admin);

            $getQty = new UserProfileController();
            $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
            $ob = $getQty->orderanCount();

            return view('datastore.bbmindex', compact('spb', 'data', 'spb_admin', 'ob'));

        }

        public function bbm(Request $request){

            $data = ProductAdmin::where('name', $request->datastore_name)->get();
            SpbCart::create([
                'author' => Auth::user()->email,
                'keterangan' => 'BBM',
                'name' => $request->get('datastore_name'),
                'slug' => $data[0]['slug'],
                'description' => $data[0]['description'],
                'supplier' => $data[0]['supplier']['name'],
                'category' => $data[0]['category']['name'],
                'stock' => $request->get('datastore_stock'),
                'price' => $data[0]['price'],
                'image' => $data[0]['image']
            ]);

            return redirect(route('datastore.bbmindex'))->with(['success' => 'Produk berhasil di BBM!' ]);

        }

        public function bbmWarehouse(){

            $author = Auth::user()->email;

            $data_bbm = SpbCart::where('keterangan', 'BBM')->where('author', $author)->get();
            $bbm = [];
            foreach ($data_bbm as $databbm) {
                $bbm[] = [
                    'bbm_name' => $databbm['name'],
                    'bbm_stock' => $databbm['stock']
                ];
            }

            foreach ($bbm as $value) {

                $bbm_name = $value['bbm_name'];
                $bbm_stock = $value['bbm_stock'];

                $data_stock_warehouse = ProductAdmin::where('name', $bbm_name)->get();

                $store_stock = $data_stock_warehouse[0]['stock'];

                $store_stock_new = $store_stock + $bbm_stock;

                ProductAdmin::where('name', $bbm_name)->update(['stock' => $store_stock_new]);

                }

            SpbCart::where('author', $author)->delete();

            return redirect(route('datastore.bbmindex'))->with(['success' => 'Berhasil di bbm!' ]);

        }

    public function destroy($id){

        $spb = SpbCart::where('id', $id)->get();

        $bbk_name = $spb[0]['name'];
        $bbk_stock = $spb[0]['stock'];

        $product = ProductAdmin::where('name', $bbk_name)->get();

        $stock_warehouse = $product[0]['stock'];

        $spb_stock_cancel = $stock_warehouse + $bbk_stock;
        ProductAdmin::where('name', $bbk_name)->update(['stock' => $spb_stock_cancel]);

        SpbCart::where('id', $id)->delete();

        return redirect(route('datastore.index'))->with(['success' => 'Spb berhasil dihapus!' ]);
    }

    public function destroyBBM($id){

        SpbCart::where('id', $id)->delete();

        return redirect(route('datastore.bbmindex'))->with(['success' => 'Spb berhasil dihapus!' ]);
    }

}
