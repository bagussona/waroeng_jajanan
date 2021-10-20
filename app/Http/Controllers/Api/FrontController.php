<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class FrontController extends Controller
{

    public function index(){

        $products = Product::orderBy('stock', 'DESC')->where('stock', '>=', 1)->paginate(10);

        return response()->json([
            'status' => 'success',
            'msg' => 'Product Display berhasil ditampilkan',
            'data' => $products
        ], 200);

    }

}
