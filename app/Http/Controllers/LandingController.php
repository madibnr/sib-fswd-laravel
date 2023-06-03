<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kategori;
use App\Models\Product;
use App\Models\Produk;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index() {
        //mengambil 8 data secara acak
        $produk = Produk::inRandomOrder(8)->get();

        //mengambil data category
        $kategori = Kategori::all();

        //mengambil data slider
        $slider = Slider::all();

        return view('landing', compact('produk', 'kategori', 'slider'));
    }
}