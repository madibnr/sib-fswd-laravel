<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $produk = Produk::with('kategori')->get();

        return view('produk.index', ['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();

        return view('produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = Produk::create([
            'kategori_id' => $request->kategori,
            'name' => $request->name,
            'caption' => $request->caption,
            'harga' => $request->harga,
        ]);

        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::where('id', $id)->with('kategori')->first();
        $produk = Produk::find($id);
        // ambil data brand dan category sebagai isian di pilihan (select)
        $kategori = Kategori::all();
        
        // tampilkan view edit dan passing data product
        return view('produk.edit', compact('produk','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // ambil data product berdasarkan id
        $produk = Produk::find($id);
        
        // update data product
        $produk->update([
            'kategori_id' => $request->kategori,
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);
        
        // redirect ke halaman product.index
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ambil data product berdasarkan id
        $produk = Produk::find($id);
        
        // hapus data product
        $produk->delete();
        
        // redirect ke halaman product.index
        return redirect()->route('produk.index');
    }
}
