<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\CartController;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){
        $getQty = new CartController();
        $getQty->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $jmlQty = $getQty->showQtyCart();
        $profile = "wkwk";
        return view('user.user_profile', compact('profile', 'jmlQty'));
    }

    public function contactUs(){
        $getQty = new CartController();
        $getQty->showQtyCart(); //MENGAMBIL DATA QTY YG SUDAH DI JUMLAH
        $jmlQty = $getQty->showQtyCart();
        $contact = "wkwk";
        return view('user.user_contact', compact('contact', 'jmlQty'));
    }
}
