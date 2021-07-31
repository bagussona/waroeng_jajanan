<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\ProductAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
public function index(){
        $product = ProductAdmin::with(['category'])->orderBy('created_at', 'DESC');

        if (request()->q != ''){
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }

        $product = $product->paginate(10);
        return view('products.index', compact('product'));

    }

    public function create(){
        $category = Category::orderBy('name', 'DESC')->get();

        return view('products.create', compact('category'));


    }

    public function store(Request $request){

            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

            ProductAdmin::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'supplier' => $request->get('supplier'),
                'category_id' => $request->get('category_id'),
                'price' => $request->get('price'),
                'stock' => $request->get('stock'),
                'price_supplier' => $request->get('price_supplier'),
                'image' => $response,
            ]);

            return redirect(route('products.index'))->with(['success' => 'Produk berhasil ditambahkan!' ]);



        }

        public function edit($id){
            $product = ProductAdmin::find($id);
            $category = Category::orderBy('name', 'DESC')->get();

            return view('products.edit', compact('product', 'category'));

        }

        public function update(Request $request, $id){
            // dd($request);
            // $this->validate($request, [
            //     'name' => 'required|string|max:100',
            //     'description' => 'required',
            //     'category_id' => 'required|exists:categories,id',
            //     'price' => 'required|integer',
            //     'weight' => 'required|integer',
            //     'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
            // ]);

            // $product = Product::find($id);
            //     $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            //     // dd($response);

            // $product->update([
            //     'name' => $request->name,
            //     'description' => $request->description,
            //     'category_id' => $request->category_id,
            //     'price' => $request->price,
            //     'weight' => $request->weight,
            //     'image' => $response
            // ]);
            // return redirect(route('product.index'))->with(['success' => 'Produk berhasil di update!']);



        }

        public function destroy($id){
            $product = Product::find($id);
            // // \Cloudinary\Uploader::destroy($id);
            $product->delete();

            return redirect(route('product.index'))->with(['success' => 'Produk Sudah Dihapus']);


        }

        // public function destroyImage(){
        //     $cloudinary->uploadApi()->destroy('filename');
        // }
}
