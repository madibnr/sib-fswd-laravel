<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Mengambil semua data produk dari model

        return view('landing', compact('products')); // Mengirim data produk ke view
    }
}
