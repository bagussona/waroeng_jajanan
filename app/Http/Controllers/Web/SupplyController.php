<?php

namespace App\Http\Controllers\Web;

use App\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserProfile\UserProfileController;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index(){
        $supplier = Supplier::all();

        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        return view('supplier.index', compact('supplier', 'ob'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories'
            ]);

        Supplier::create([
            'name' => $request->get('name'),
        ]);

        return redirect(route('supplier.index'))->with(['success' => 'Supplier baru ditambahkan!']);
    }

    public function edit($id){
        $supplier = Supplier::find($id); //Query track by ID

        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        return view('supplier.edit', compact('supplier', 'ob'));

    }

    public function update(Request $request, $id){
        // dd($request);

        $this->validate($request, [
            'name' => 'required|string|max:50' . $id
        ]);
        $supplier = Supplier::find($id);
        $supplier->update([
            'name' => $request->name,
        ]);

        return redirect(route('supplier.index'))->with(['success' => 'Supplier berhasil di update!']);

    }

    public function destroy($id){
        // dd($id);

        Supplier::where('id', $id)->delete();

        return redirect(route('supplier.index'))->with(['success' => 'Supplier berhasil dihapus!']);
    }
}
