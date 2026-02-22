<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::latest()->paginate(20);
        return view('admin.desa.index', compact('desas'));
    }

    public function create()
    {
        return view('admin.desa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'website_url' => 'nullable|url|max:255',
            'kepala_desa' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('desa', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Desa::create($validated);

        return redirect()->route('admin.desa.index')
            ->with('success', 'Data desa berhasil ditambahkan!');
    }

    public function edit(Desa $desa)
    {
        return view('admin.desa.edit', compact('desa'));
    }

    public function update(Request $request, Desa $desa)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'website_url' => 'nullable|url|max:255',
            'kepala_desa' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'is_active' => 'boolean',
        ]);

        if ($validated['name'] !== $desa->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('logo')) {
            if ($desa->logo) {
                Storage::disk('public')->delete($desa->logo);
            }
            $validated['logo'] = $request->file('logo')->store('desa', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $desa->update($validated);

        return redirect()->route('admin.desa.index')
            ->with('success', 'Data desa berhasil diperbarui!');
    }

    public function destroy(Desa $desa)
    {
        if ($desa->logo) {
            Storage::disk('public')->delete($desa->logo);
        }

        $desa->delete();

        return redirect()->route('admin.desa.index')
            ->with('success', 'Data desa berhasil dihapus!');
    }
}
