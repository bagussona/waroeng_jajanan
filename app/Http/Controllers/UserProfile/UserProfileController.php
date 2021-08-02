<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\CartController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        $uid = Auth::user()->id;
        $profile = User::find($uid);

        return view('user.user_profile', compact('profile'));

    }

    public function contactUs(){
        // $getQty = new CartController();
        // $getQty->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        // $jmlQty = $getQty->showQtyCart();
        // $contact = "wkwk";
        // return view('user.user_contact', compact('contact', 'jmlQty'));
        return view('user.user_contact');



    }
}
