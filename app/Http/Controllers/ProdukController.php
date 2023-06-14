<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function getAllUser()
    {
        $sliders =  Slider::all();
        return view('slider', compact("slider"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get the selected status from the request
        $status = $request->status;
    
        // Query the sliders based on the selected status
        $query = Produk::query();
    
        if ($status) {
            $query->where('status', $status);
        }
    
        // Get the filtered sliders
        $produk = $query->get();
    
        // Get the count of pending sliders
        $pendingCountP = $this->getPendingCountP();
    
        // passing data sliders, status, and pending count to view slider.index
        return view('produk.index', compact('produk', 'status', 'pendingCountP'));
    }

    public function getPendingCountP()
    {
        $pendingCountP = Produk::where('status', 'pending')->count();
    
        return $pendingCountP;
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
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
            'name' => 'required|min:3',
            'caption' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah upload file
        if ($request->hasFile('image')) {
            $name = $request->file('image');
            $imageName = 'Produk_' . time() . '.' . $name->getClientOriginalExtension();
            $path = Storage::putFileAs('public/produk', $request->file('image'), $imageName);
        }

        $produk = Produk::create([
            'kategori_id' => $request->kategori,
            'name' => $request->name,
            'caption' => $request->caption,
            'harga' => $request->harga,
            'status' => $request->status,
            'image' => $path, // Simpan path gambar ke kolom 'image'
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
        // cek jika user mengupload gambar di form
        if ($request->hasFile('image')) {
            // ambil nama file gambar lama dari database
            $old_image = Slider::find($id)->image;
    
            // hapus file gambar lama dari folder slider
            Storage::delete('public/produk/'.$old_image);
    
            // FILE BARU //
            // ubah nama file gambar baru dengan angka random
            $imageName = time().'.'.$request->image->extension();
    
            // upload file gambar ke folder slider
            Storage::putFileAs('public/produk', $request->file('image'), $imageName);
    
            // update data sliders
            Produk::where('id', $id)->update([
                'kategori_id' => $request->kategori_id,
                'name' => $request->name,
                'caption' => $request->caption,
                'harga' => $request->harga,
                'status' => $request->status, // Fixed: Change $request->caption to $request->status
                'image' => $imageName,
            ]);
    
        } else {
            // jika user tidak mengupload gambar
            // update data sliders hanya untuk title, caption, dan status
            Produk::where('id', $id)->update([
                'name' => $request->name,
                'caption' => $request->caption,
                'harga' => $request->harga,
                'status' => $request->status, // Fixed: Change $request->caption to $request->status
            ]);
        }
    
    
        // alihkan halaman ke halaman sliders
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
