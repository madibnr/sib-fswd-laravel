<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function getAllUser()
    {
        $sliders = Slider::all();
        return view('slider', compact('sliders'));
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
        $query = Slider::query();
    
        if ($status) {
            $query->where('status', $status);
        }
    
        // Get the filtered sliders
        $sliders = $query->get();
    
        // Get the count of pending sliders
        $pendingCount = $this->getPendingCount();
    
        // passing data sliders, status, and pending count to view slider.index
        return view('slider.index', compact('sliders', 'status', 'pendingCount'));
    }
    
    public function getPendingCount()
    {
        $pendingCount = Slider::where('status', 'pending')->count();
    
        return $pendingCount;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // menampilkan halaman create
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the authenticated user has the role 'Staff'
        if (Auth::user()->role->name == 'Staff') {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required',
                'caption' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Get the file from the request
            $image = $request->file('image');
    
            // Generate a unique file name
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the image in the 'public/slider' directory
            $image->storeAs('public/slider', $imageName);
    
            // Create a new Slider instance
            $slider = new Slider();
            $slider->title = $validatedData['title'];
            $slider->caption = $validatedData['caption'];
            $slider->image = $imageName;
            $slider->status = 'pending'; // Set the status to 'pending'
            $slider->save();
    
            // Redirect to the index page or any other page as needed
            return redirect()->route('slider.index');
        } else {
            // Redirect to unauthorized page or show an error message
            return redirect()->route('unauthorized');
        }
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
        // cari data berdasarkan id menggunakan find()
        // find() merupakan fungsi eloquent untuk mencari data berdasarkan primary key
        $slider = Slider::find($id);

        // load view edit.blade.php dan passing data slider
        return view('slider.edit', compact('slider'));
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
            Storage::delete('public/slider/'.$old_image);
    
            // FILE BARU //
            // ubah nama file gambar baru dengan angka random
            $imageName = time().'.'.$request->image->extension();
    
            // upload file gambar ke folder slider
            Storage::putFileAs('public/slider', $request->file('image'), $imageName);
    
            // update data sliders
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
                'status' => $request->status, // Fixed: Change $request->caption to $request->status
                'image' => $imageName,
            ]);
    
        } else {
            // jika user tidak mengupload gambar
            // update data sliders hanya untuk title, caption, dan status
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
                'status' => $request->status, // Fixed: Change $request->caption to $request->status
            ]);
        }
    
    
        // alihkan halaman ke halaman sliders
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari data berdasarkan id menggunakan find()
        // find() merupakan fungsi eloquent untuk mencari data berdasarkan primary key
        $slider = Slider::find($id);

        // hapus file gambar dari folder slider
        Storage::delete('public/slider/'.$slider->image);

        // hapus data dari table sliders
        $slider->delete();

        // alihkan halaman ke halaman sliders
        return redirect()->route('slider.index');
    }
    
}
