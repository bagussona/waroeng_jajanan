<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\FrontController;
use App\OrderDetail;
use App\OrderHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        $uid = Auth::user()->id;
        $profile = User::find($uid);

        $getQty = new FrontController();
        $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty->notificationCart();

        $uid = Auth::user()->id;
        $order_detail = OrderHistory::where('customer_id', $uid)->get();

        return view('user.user_order', compact('profile', 'licart', 'order_detail'));

    }

    public function update(Request $request){
        // dd($request);
        $uid = Auth::user()->id;

        $this->validate($request, [
            'name' => 'required|string|max:100',
            'nohape' => 'required|string',
            'gender' => 'required|string',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        if (empty($_FILES['avatar']['tmp_name'])) {

            $profile = User::find($uid);
            $profile->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'nohape' => $request->get('nohape'),
                'gender' => $request->get('gender'),
                'avatar' => $profile->avatar
            ]);
        } else {
                $response = cloudinary()->upload($request->file('avatar')->getRealPath())->getSecurePath();

                $profile = User::find($uid);
                $profile->update([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'nohape' => $request->get('nohape'),
                    'gender' => $request->get('gender'),
                    'avatar' => $response
                ]);
            }

            return redirect(route('front.UserProfile'))->with(['success' => 'Profile berhasil di update!']);
    }

    public function contactUs(){

        $getQty = new FrontController();
        $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty->notificationCart();

        return view('user.user_contact', compact('licart'));

    }

    public function orderan(){
        $order_history = OrderHistory::all();

        $status = 'Proses';
        $order_detail = OrderHistory::where('status', $status)->get();

        return view('orderan.index', compact('order_history', 'order_detail'));
    }

    public function view(Request $request){
        // dd($request);
        $this->validate($request, [
            'invoice' => 'required|string'
        ]);

        $invoice = $request->get('invoice');
        // dd($invoice);

        $order_detail = OrderDetail::where('order_id', $invoice)->get();
        $order_history = OrderHistory::where('invoice', $invoice)->get();
        // dd($order_history);

        return view('orderan.detail', compact('order_history', 'order_detail'));
    }

    public function updateOrderan(Request $request){
        $this->validate($request, [
            'invoice' => 'required|string'
        ]);

        $invoice = $request->get('invoice');
            // dd($invoice);
        OrderHistory::where('invoice', $invoice)->update(['status' => 'Selesai']);

        return redirect()->back();
    }

    public function viewCustomer(Request $request){
        // dd($request);
        $this->validate($request, [
            'invoice' => 'required|string'
        ]);

        $invoice = $request->get('invoice');
        // dd($invoice);

        $order_detail = OrderDetail::where('order_id', $invoice)->get();
        $order_history = OrderHistory::where('invoice', $invoice)->get();
        // dd($order_history);

        return view('orderan.detail', compact('order_history', 'order_detail'));
    }
}
