<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use Illuminate\Http\Request;

class PotensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Potensi::active();

        // Filter by category
        if ($request->filled('category')) {
            $query->category($request->category);
        }

        $potensis = $query->latest()->paginate(12);
        $categories = Potensi::active()->distinct()->pluck('category');

        return view('public.potensi.index', compact('potensis', 'categories'));
    }

    public function show($slug)
    {
        $potensi = Potensi::active()->where('slug', $slug)->firstOrFail();

        // Get related  potensi
        $related = Potensi::active()
            ->where('id', '!=', $potensi->id)
            ->where('category', $potensi->category)
            ->latest()
            ->take(3)
            ->get();

        return view('public.potensi.show', compact('potensi', 'related'));
    }
}
