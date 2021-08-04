<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\FrontController;
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

        return view('user.user_profile', compact('profile', 'licart'));

    }

    public function contactUs(){

        $getQty = new FrontController();
        $getQty->notificationCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $licart = $getQty->notificationCart();

        return view('user.user_contact', compact('licart'));

    }
}
