<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index(Request $request) {
        //mengambil data
        $produk = Produk::all();

        //mengambil data category
        $kategori = Kategori::all();

        //mengambil data slider
        $slider = Slider::all();

        if ($request->kategori) {
            $produks = Product::with('kategori')->whereHas('kategori', function ($query) use ($request) {
                $query->where('name', $request->kategori);
            })->get();
        } else if ($request->min && $request->max) {
            $produks = Produk::where('harga', '>=', $request->min)->where('harga', '<=', $request->max)->get();
        } else {
            // mengambil data
            $produks = Produk::all();
        }

        return view('landing', compact('produk', 'kategori', 'slider'));
    }
}