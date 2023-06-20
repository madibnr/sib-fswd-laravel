<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data produk',
            'data' => $produk
        ], 200);
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        if ($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data produk',
                'data' => $produk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data produk tidak ditemukan',
                'data' => ''
            ], 404);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'name' => 'required|string|min:3',
            'harga' => 'required|integer',
            //'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid',
                'data' => $validator->errors()
            ], 422);
        }

        // // ubah nama file
        // $imageName = time() . '.' . $request->image->extension();

        // // simpan file ke folder public/product
        // Storage::putFileAs('public/product', $request->image, $imageName);

        $produk = Produk::create([
            'kategori_id' => $request->category_id,
            'name' => $request->name,
            'harga' => $request->price,
            // 'image' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'kategori_id' => 'required',
            'name' => 'required|string|min:3',
            'harga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid',
                'data' => $validator->errors()
            ], 422);
        }

        $produk = Produk::find($id);

        if ($produk) {
            $produk = $produk->update([
                'kategori_id' => $request->kategory_id,
                'name' => $request->name,
                'price' => $request->price,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diupdate',
                'data' => Produk::find($id)
            ], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
                'data' => ''
            ], 404);
        }
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if ($produk) {
            $produk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus',
                'data' => null
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
                'data' => ''
            ], 404);
        }
    }
}