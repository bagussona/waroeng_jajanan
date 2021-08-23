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
        $order_detail = OrderHistory::where('customer_id', $uid)->paginate(8);

        return view('user.user_profile', compact('profile', 'licart', 'order_detail'));

    }

    public function update(Request $request){
        // dd($request);
        $uid = Auth::user()->id;

        $this->validate($request, [
            'name' => 'required|string|max:100',
            'nohape' => 'required|string',
            'gender' => 'required|string',
        ]);

            $profile = User::find($uid);
            $profile->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'nohape' => $request->get('nohape'),
                'gender' => $request->get('gender'),
            ]);

            return redirect(route('front.UserProfile'))->with(['success' => 'Profile berhasil di update!']);
    }

    public function contactUs(){

        $getQty = new FrontController();
        $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty->notificationCart();

        return view('user.user_contact', compact('licart'));

    }

    public function orderan(){
        $order_history = OrderHistory::paginate(10);

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

    public function crop(Request $request){
        $uid = Auth::user()->id;

        $this->validate($request, [
            'avatar' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $response = cloudinary()->upload($request->file('avatar')->getRealPath(), [
            'folder' => 'profile',
            'transformation' => [
                'quality' => 50,
                'fetch_format' => 'auto'
                ]
        ])->getSecurePath();
        // $response = $this->update($request);

        if($response){

            $avatar = User::find($uid);
            $avatar->update([
                'avatar' => $response
            ]);

            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.']);
        } else {

            return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);

        }

    }

}
