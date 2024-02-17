<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) { // Check if user is authenticated
            $role = Auth::user()->role;
            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role == 'user') {
                $products = Product::all();
                return view('User.Home.index', compact('products'));
            }else{
                return redirect()->back();
            }
        }
    }

    public function displayHome()
    {
        $products = Product::all();
        return view('User.Home.index', compact('products'));
    }
}
