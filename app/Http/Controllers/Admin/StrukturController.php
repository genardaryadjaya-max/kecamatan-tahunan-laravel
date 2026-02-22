<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $strukturs = Struktur::whereNull('parent_id')->orderBy('order')->get();
        $allStruktur = Struktur::orderBy('order')->get();
        return view('admin.struktur.index', compact('strukturs', 'allStruktur'));
    }

    public function create()
    {
        $parents = Struktur::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.struktur.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'nip'         => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
            'parent_id'   => 'nullable|exists:strukturs,id',
            'is_active'   => 'boolean',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('struktur', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 1);

        Struktur::create($validated);

        return redirect()->route('admin.struktur.index')->with('success', 'Anggota struktur berhasil ditambahkan!');
    }

    public function edit(Struktur $struktur)
    {
        $parents = Struktur::whereNull('parent_id')->where('id', '!=', $struktur->id)->orderBy('order')->get();
        return view('admin.struktur.edit', compact('struktur', 'parents'));
    }

    public function update(Request $request, Struktur $struktur)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'nip'         => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
            'parent_id'   => 'nullable|exists:strukturs,id',
            'is_active'   => 'boolean',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($struktur->photo) {
                Storage::disk('public')->delete($struktur->photo);
            }
            $validated['photo'] = $request->file('photo')->store('struktur', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order']     = $request->input('order', 1);

        $struktur->update($validated);

        return redirect()->route('admin.struktur.index')->with('success', 'Data struktur berhasil diperbarui!');
    }

    public function destroy(Struktur $struktur)
    {
        if ($struktur->photo) {
            Storage::disk('public')->delete($struktur->photo);
        }
        $struktur->delete();
        return redirect()->route('admin.struktur.index')->with('success', 'Data berhasil dihapus!');
    }
}
