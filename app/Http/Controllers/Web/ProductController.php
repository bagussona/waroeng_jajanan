<?php

namespace App\Http\Controllers\Web;

use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(){
        $product = Product::with(['category'])->orderBy('created_at', 'DESC');
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

        // dd($request);
        // $this->validate($request, [
        //     'name' => 'required|string|max:100',
        //     'descsription' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'price' => 'required|integer',
        //     'weight' => 'required|integer',
        //     'image' => 'required|image|mimes:png,jpeg,jpg',
        // ]);

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:100',
        //     'descsription' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'price' => 'required|integer',
        //     'weight' => 'required|integer',
        //     'image' => 'required|image|mimes:png,jpeg,jpg',
        // ]);
        // dd($validator);

        // if($validator->fails()){
        //     return response()->json([
        //     'status'        => 'failed',
        //     'message'       => 'Something went wrong',
        //     'data'          => $validator
        //     ], Response::HTTP_BAD_REQUEST);
        // }

        // if ($request->hasFile('image')){
            // $file = $request->file('image');
            // $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            // $file->storeAs('public/products', $response);

            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            // dd($response);

            // $result = $request->file->storeOnCloudinary('/tookoo-dil');
            // dd($result);

            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image' => $response,
                'price' => $request->price,
                'weight' => $request->weight,
                'status' => $request->status,
            ]);

            // dd($product);
            // dd($response->getRealPath());

            return redirect(route('product.index'))->with(['success' => 'Produk berhasil ditambahkan!' ]);
        }

        public function edit($id){
            $product = Product::find($id);
            $category = Category::orderBy('name', 'DESC')->get();
            return view('products.edit', compact('product', 'category'));
        }

        public function update(Request $request, $id){
            // dd($request);
            $this->validate($request, [
                'name' => 'required|string|max:100',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|integer',
                'weight' => 'required|integer',
                'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
            ]);

            $product = Product::find($id);
                $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                // dd($response);

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'weight' => $request->weight,
                'image' => $response
            ]);
            return redirect(route('product.index'))->with(['success' => 'Produk berhasil di update!']);
        }

        public function destroy($id){
            $product = Product::find($id);
            // \Cloudinary\Uploader::destroy($id);
            $product->delete();

            return redirect(route('product.index'))->with(['success' => 'Produk Sudah Dihapus']);
        }

        // public function destroyImage(){
        //     $cloudinary->uploadApi()->destroy('filename');
        // }
}
