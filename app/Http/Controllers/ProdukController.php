<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function getAllUser()
    {
        $produk =  Produk::all();
        return view('produk', compact("produk"));
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
        $request->validate([
            'kategori_id' => 'required',
            'name' => 'required',
            'caption' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,svg+xml',
        ]);
    
        // Check if the authenticated user has the role "Staff"
        if (Auth::check() && Auth::user()->role->name === 'Staff') {
            $status = 'pending';
        } else {
            $request->validate([
                'status' => 'required|in:approve,pending,reject',
            ]);
    
            $status = $request->status;
        }
    
        // Check if the request has an uploaded file
        if ($request->hasFile('image')) {
            $name = $request->file('image');
            $imageName = 'Produk_' . time() . '.' . $name->getClientOriginalExtension();
            $path = Storage::putFileAs('public/produk', $request->file('image'), $imageName);
        }
    
        // Insert data into the `produk` table
        DB::table('produk')->insert([
            'kategori_id' => $request->kategori_id,
            'name' => $request->name,
            'caption' => $request->caption,
            'harga' => $request->harga,
            'status' => $status,
            'image' => $imageName,
        ]);
    
        // Redirect to the produk index page
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
            $old_image = Produk::find($id)->image;
    
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
        // Get the product by ID
        $produk = Produk::find($id);

        // Check if the product exists
        if ($produk) {
            // Delete the associated image from storage
            Storage::delete('public/produk/' . $produk->image);

            // Delete the product
            $produk->delete();
        }

        // Redirect to the product index page
        return redirect()->route('produk.index');
    }
}
