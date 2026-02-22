<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Desa;
use App\Models\Potensi;
use App\Models\Slider;
use App\Models\Statistik;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_berita' => Berita::count(),
            'published_berita' => Berita::published()->count(),
            'total_desa' => Desa::count(),
            'active_desa' => Desa::active()->count(),
            'total_potensi' => Potensi::count(),
            'active_potensi' => Potensi::active()->count(),
            'total_slider' => Slider::count(),
            'total_statistik' => Statistik::count(),
            'total_admin' => User::where('role', 'admin')->count(),
        ];

        $latest_berita = Berita::latest()->take(5)->get();
        $latest_potensi = Potensi::latest()->take(3)->get();

        return view('admin.dashboard', compact('stats', 'latest_berita', 'latest_potensi'));
    }
}
