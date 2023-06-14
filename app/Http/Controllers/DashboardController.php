<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SliderController;
use App\Models\Slider;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the count of pending sliders
        $pendingCount = Slider::where('status', 'pending')->count();
        $pendingCountP = Produk::where('status', 'pending')->count();

        // Pass the pendingCount variable to the view
        return view('dashboard', compact('pendingCount', 'pendingCountP'));
    }
}