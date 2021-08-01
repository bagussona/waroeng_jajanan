<?php

namespace App\Http\Controllers\Web;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();

        return view('categories.index', compact('category'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories'
            ]);

        $request->request->add(['slug' => $request->name]);

        Category::create($request->except('_token'));

        return redirect(route('category.index'))->with(['success' => 'Kategori baru ditambahkan!']);
    }

    public function edit($id){
        $category = Category::find($id); //Query track by ID

        // dd($category);
        return view('categories.edit', compact('category'));

    }

    public function update(Request $request, $id){
        // dd($request);

        $this->validate($request, [
            'name' => 'required|string|max:50' . $id
        ]);
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
        ]);

        // dd($category);

        return redirect(route('category.index'))->with(['success' => 'Kategori berhasil di update!']);

    }

    public function destroy($id){
        // dd($id);
        Category::where('id', $id)->delete();

           return redirect(route('category.index'))->with(['success' => 'Kategori berhasil dihapus!']);
        }

}
