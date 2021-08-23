<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Category;
use App\ProductAdmin;
use App\Supplier;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function index(){
        $product = ProductAdmin::with(['category', 'supplier'])->orderBy('created_at', 'DESC');

        if (request()->q != ''){
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }

        $product = $product->paginate(10);
        return view('products.index', compact('product'));

    }

    public function display(){
        $display = Product::orderBy('created_at', 'DESC');

        if (request()->q != ''){
            $display = $display->where('name', 'LIKE', '%' . request()->q . '%');
        }

        $display = $display->paginate(10);

        return view('products.display', compact('display'));

    }

    public function create(){
        $category = Category::orderBy('name', 'DESC')->get();
        $supplier = Supplier::orderBy('name', 'DESC')->get();

        return view('products.create', compact('category', 'supplier'));

    }

    public function store(Request $request){

        $response = cloudinary()->upload($request->file('image')->getRealPath(), [
            'folder' => 'product',
            'transformation' => [
                'width => 600',
                'height => 600',
                'quality => 50'
            ]
        ])->getSecurePath();

        ProductAdmin::create([
            'name' => $request->get('name'),
            'slug' => $request->get('name'),
            'description' => $request->get('description'),
            'supplier_id' => $request->get('supplier_id'),
            'category_id' => $request->get('category_id'),
            'price_supplier' => $request->get('price_supplier'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'image' => $response,
        ]);

        return redirect(route('products.index'))->with(['success' => 'Produk berhasil ditambahkan!' ]);

    }

    public function edit($id){
        $product = ProductAdmin::find($id);
        $category = Category::orderBy('name', 'DESC')->get();
        $supplier = Supplier::orderBy('name', 'DESC')->get();

        return view('products.edit', compact('product', 'category', 'supplier'));

    }

    public function update(Request $request, $id){
        // dd($request);
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'price_supplier' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        if (empty($_FILES['image']['tmp_name']) ) {

            $product = ProductAdmin::find($id);
            // dd($product->image);
            $product->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'supplier_id' => $request->get('supplier_id'),
                'category_id' => $request->get('category_id'),
                'price_supplier' => $request->get('price_supplier'),
                'stock' => $request->get('stock'),
                'price' => $request->get('price'),
                'image' => $product->image
                ]);
            } else {

                $response = cloudinary()->upload($request->file('image')->getRealPath(), [
                    'folder' => 'product',
                    'transformation' => '[width => 600, height => 600]',
                ])->getSecurePath();
                // dd($response);
                $product = ProductAdmin::find($id);
                $product->update([
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                    'supplier_id' => $request->get('supplier_id'),
                    'category_id' => $request->get('category_id'),
                    'price_supplier' => $request->get('price_supplier'),
                    'stock' => $request->get('stock'),
                    'price' => $request->get('price'),
                    'image' => $response
                    ]);

            }

            // dd($product);

        return redirect(route('products.index'))->with(['success' => 'Produk berhasil di update!']);

    }

    public function destroy($id){
        $product = ProductAdmin::find($id);
        $product->delete();

        return redirect(route('products.index'))->with(['success' => 'Produk Sudah Dihapus']);

    }

    ## transfer from warehouse to display store

}
