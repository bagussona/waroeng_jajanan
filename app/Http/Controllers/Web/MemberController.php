<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderHistory;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserProfile\UserProfileController;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // dd($users);
        $users = User::paginate(10);
        // dd($users);
        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        // dd($users);

        return view('member.index', compact('users', 'ob'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request);
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        // dd($order);
        $getQty = new UserProfileController();
        $getQty->orderanCount(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $ob = $getQty->orderanCount();

        return view('member.detail', compact('profile', 'orders', 'sisa_hutang', 'total_transaksi', 'ob'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        User::find($id)->delete();

        return redirect()->back()->with(['success' => 'Berhasil dihapus']);
    }
}
