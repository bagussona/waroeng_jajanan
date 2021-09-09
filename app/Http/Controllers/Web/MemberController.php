<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderHistory;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserProfile\UserProfileController;
use App\Order;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function index(){

        $users = User::orderBy('created_at')->paginate(10);

        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        return view('member.index', compact('users', 'ob'));

    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'string|required|max:50',
            'email' => 'string|required|email|unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed'
        ]);

        $register = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        $register->assignRole('staff');

        return redirect(route('members.index'))->with(['success' => 'Staff baru ditambahkan!']);

    }

    public function show($id){

        $profile = User::find($id);
        $orders = OrderHistory::where('customer_id', $id)->paginate(5);

        $hitungan = OrderHistory::where('customer_id', $id)->get();
        $sisa_hutang = collect($hitungan)->sum(function($q) {
            return $q['sisa_hutang'];
        });
        $total_transaksi = collect($hitungan)->sum(function($q) {
            return $q['telah_bayar'];
        });

        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        $carts = Order::where('user_id', $id)->paginate(5);

        return view('member.detail', compact('profile', 'orders', 'sisa_hutang', 'total_transaksi', 'ob', 'carts'));

    }

    public function destroy($id){

        User::find($id)->delete();

        return redirect()->back()->with(['success' => 'Berhasil dihapus']);

    }

}
