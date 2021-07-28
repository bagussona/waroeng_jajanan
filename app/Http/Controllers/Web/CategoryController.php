<?php

namespace App\Http\Controllers\Web;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        // $category = Category::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);
        // $parent = Category::getParent()->orderBy('name', 'DESC')->get();
        // return view('categories.index', compact('category', 'parent'));


    }

    public function store(Request $request){
        // $this->validate($request, [
        //     'name' => 'required|string|max:50|unique:categories'
        //     ]);
        // $request->request->add(['slug' => $request->name]);
        // Category::create($request->except('_token'));
        // return redirect(route('category.index'))->with(['success' => 'Kategori baru ditambahkan!']);



    }

    public function edit($id){
        // $category = Category::find($id); //Query track by ID
        // $parent = Category::getParent()->orderBy('name', 'ASC')->get();
        // return view('categories.edit', compact('category', 'parent'));



    }

    public function update(Request $request, $id){
        // $this->validate($request, [
        //     'name' => 'required|string|max:50|unique:categories,name,' . $id
        // ]);
        // $category = Category::find($id);
        // $category->update([
        //     'name' => $request->name,
        //     'parent_id' => $request->parent_id
        // ]);
        // return redirect(route('category.index'))->with(['success' => 'Kategori berhasil di update!']);



    }

    public function destroy($id){
        $category = Category::withCount(['child', 'product'])->find($id);
        if ($category->child_count == 0 && $category->product_count == 0){
            $category->delete();

            return redirect(route('category.index'))->with(['success' => 'Kategori berhasil dihapus!']);
        }
            return redirect(route('category.index'))->with(['failed' => 'Kategori memiliki anak kategori!']);
    }
}
