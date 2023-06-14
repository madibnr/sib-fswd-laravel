<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Ambil semua data user dari database
         $user = User::with('role')->get();
        
         // Tampilkan halaman index
         return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // Ambil data roles dari database
         $roles = Role::all();
        
         // Tampilkan form create user dengan passing data roles
         return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //validasi
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        
        // // Simpan gambar ke direktori
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);

        // Simpan data ke database
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            //'image' => $request->image,
        ]);

        // Redirect ke halaman user.index
        return redirect()->route('user.index');
        // Redirect atau tampilkan pesan berhasil
        //return redirect()->back()->with('success', 'Gambar berhasil diunggah.');
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
        // Ambil data user berdasarkan id
        $user = User::find($id);
        
        // Ambil data roles dari database
        $role = Role::all();
        
        // Tampilkan halaman edit dengan passing data user dan roles
        return view('user.edit', compact('user', 'role'));
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
        // Ambil data user berdasarkan id
        $user = User::find($id);
    
        // ...
    
        // Periksa apakah request memiliki input password
        if ($request->has('password')) {
            // Update dengan password baru yang di-hash
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);
        } else {
            // Update tanpa mengubah password
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $request->role_id,
            ]);
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Ambil data user berdasarkan id
       $user = User::find($id);
        
       // Hapus data user
       $user->delete();
       
       // Redirect ke halaman user.index
       return redirect()->route('user.index');
    }
}
