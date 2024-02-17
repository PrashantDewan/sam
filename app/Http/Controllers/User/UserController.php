<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;


class UserController extends Controller
{

    public function displaySingleProduct($id){
        try{
            $product = Product::findOrFail($id);
            return view('User.Pages.single-product', compact('product'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
