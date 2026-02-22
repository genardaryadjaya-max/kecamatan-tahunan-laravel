<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Desa;
use App\Models\Potensi;
use App\Models\Slider;
use App\Models\Statistik;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        // Ambil slider aktif (untuk hero video/image)
        $sliders = Slider::active()->get();

        // Ambil berita terbaru (4 item)
        $beritas = Berita::published()
            ->latest('published_at')
            ->take(4)
            ->get();

        // Ambil desa aktif
        $desas = Desa::active()->orderBy('name')->get();

        // Ambil potensi terbaru (4 item)
        $potensis = Potensi::active()
            ->latest()
            ->take(4)
            ->get();

        // Ambil statistik tahun ini, dikelompokkan per kategori
        $statistiks = Statistik::year(date('Y'))
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        // Ambil Layanan Publik
        $layanans = \App\Models\Layanan::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Ambil Agenda (mendatang)
        $agendas = \App\Models\Agenda::where('is_active', true)
            ->where('date_time', '>=', now())
            ->orderBy('date_time', 'asc')
            ->take(5)
            ->get();

        // Ambil Tautan Sosial
        $sosmed = [
            'facebook' => \App\Models\Setting::get('sosmed_facebook'),
            'twitter' => \App\Models\Setting::get('sosmed_twitter'),
            'instagram' => \App\Models\Setting::get('sosmed_instagram'),
            'youtube' => \App\Models\Setting::get('sosmed_youtube'),
        ];

        return view('public.index', compact(
            'sliders',
            'beritas',
            'desas',
            'potensis',
            'statistiks',
            'layanans',
            'agendas',
            'sosmed'
        ));
    }

    /**
     * Berita Index - Daftar semua berita
     */
    public function berita(Request $request)
    {
        $query = Berita::published()->latest('published_at');

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->category($request->category);
        }

        $beritas = $query->paginate(12);
        $categories = Berita::published()->distinct()->pluck('category');

        return view('public.berita.index', compact('beritas', 'categories'));
    }

    /**
     * Berita Show - Detail berita
     */
    public function beritaShow($slug)
    {
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();

        // Increment view count
        $berita->incrementViews();

        // Related berita (same category, exclude current)
        $related = Berita::published()
            ->where('id', '!=', $berita->id)
            ->where('category', $berita->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.berita.show', compact('berita', 'related'));
    }

    /**
     * Desa Index - Daftar semua desa
     */
    public function desa()
    {
        $desas = Desa::active()->orderBy('name')->get();
        return view('public.desa.index', compact('desas'));
    }

    /**
     * Desa Show - Detail desa
     */
    public function desaShow($slug)
    {
        $desa = Desa::active()->where('slug', $slug)->firstOrFail();
        return view('public.desa.show', compact('desa'));
    }

    /**
     * Statistik - Halaman statistik kecamatan
     */
    public function statistik(Request $request)
    {
        $availableYears = Statistik::selectRaw('DISTINCT year')
            ->orderByDesc('year')
            ->pluck('year');

        $currentYear = $request->query('year', $availableYears->first() ?? date('Y'));

        // Ambil data statistik tahun yang dipilih, dikelompokkan per kategori
        $statistiks = Statistik::year($currentYear)
            ->orderBy('category')
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        return view('public.statistik', compact('statistiks', 'currentYear', 'availableYears'));
    }

    /**
     * Unduhan - Halaman download dokumen
     */
    public function unduhan()
    {
        $unduhans = \App\Models\Unduhan::orderBy('category')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('category');

        return view('public.unduhan', compact('unduhans'));
    }

    /**
     * FAQ - Halaman Frequently Asked Questions
     */
    public function faq()
    {
        $faqs = \App\Models\Faq::orderBy('order')
            ->get()
            ->groupBy('category');

        return view('public.faq', compact('faqs'));
    }

    /**
     * Tampilkan Form Pendaftaran Potensi Publik
     */
    public function createPotensi()
    {
        return view('public.potensi-daftar');
    }

    /**
     * Proses Pengajuan Potensi Publik
     */
    public function storePotensi(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|url|max:255',
        ]);

        // Generate slug
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . time();

        // Handle main image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('potensi', 'public');
        }

        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('potensi/gallery', 'public');
            }
            $validated['gallery'] = json_encode($galleryPaths);
        }

        // Force inactive for admin review
        $validated['is_active'] = false;

        \App\Models\Potensi::create($validated);

        return redirect()->back()
            ->with('success', 'Terima kasih! Usulan potensi daerah Anda telah berhasil dikirim dan saat ini sedang menunggu tinjauan dari admin.');
    }
}
