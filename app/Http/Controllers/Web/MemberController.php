<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderHistory;
use App\User;
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

    public function update(Request $request, $id){

        $user = User::find($id);
        $user->update([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'nohape' => $request->get('phone'),
            'gender' => $request->get('gender'),
        ]);

        return redirect()->back()->with(['success' => 'Berhasil diupdate']);

    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'string|required|max:50',
            'email' => 'string|required|email|unique:users',
            'username' => 'string|required',
            'password' => 'required', 'string', 'min:8', 'confirmed'
        ]);

        $register = User::create([
            'name' => $request->get('name'),
            'avatar' => 'https://res.cloudinary.com/tookoo-dil/image/upload/v1623985010/BTS-ID/user.png',
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'nohape' => $request->get('nohape'),
            'gender' => $request->get('gender')
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
