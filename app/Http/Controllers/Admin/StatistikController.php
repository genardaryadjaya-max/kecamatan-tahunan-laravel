<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $statistiks = Statistik::orderBy('year', 'desc')->orderBy('order')->paginate(50);
        return view('admin.statistik.index', compact('statistiks'));
    }

    public function create()
    {
        $categories = ['penduduk', 'pertanian', 'kesehatan', 'pendidikan', 'ekonomi', 'infrastruktur'];
        return view('admin.statistik.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:100',
            'unit' => 'nullable|string|max:50',
            'year' => 'required|integer|min:2000|max:2100',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
        ]);

        Statistik::create($validated);

        return redirect()->route('admin.statistik.index')
            ->with('success', 'Statistik berhasil ditambahkan!');
    }

    public function edit(Statistik $statistik)
    {
        $categories = ['penduduk', 'pertanian', 'kesehatan', 'pendidikan', 'ekonomi', 'infrastruktur'];
        return view('admin.statistik.edit', compact('statistik', 'categories'));
    }

    public function update(Request $request, Statistik $statistik)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:100',
            'unit' => 'nullable|string|max:50',
            'year' => 'required|integer|min:2000|max:2100',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
        ]);

        $statistik->update($validated);

        return redirect()->route('admin.statistik.index')
            ->with('success', 'Statistik berhasil diperbarui!');
    }

    public function destroy(Statistik $statistik)
    {
        $statistik->delete();

        return redirect()->route('admin.statistik.index')
            ->with('success', 'Statistik berhasil dihapus!');
    }
}
