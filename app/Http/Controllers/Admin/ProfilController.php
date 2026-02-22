<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function index()
    {
        // Clean up any old duplicate / wrong-slug entries
        Profil::whereIn('slug', ['visi-dan-misi-kecamatan-tahunan', 'visi', 'visi-misi-kecamatan-tahunan'])
            ->orWhere('title', 'like', 'Visi dan Misi%')
            ->delete();

        // Ensure default profiles exist
        $sections = ['Sejarah', 'Visi Misi', 'Struktur Organisasi', 'Geografis'];
        foreach ($sections as $section) {
            Profil::firstOrCreate(
                ['slug' => Str::slug($section)],
                ['title' => $section, 'content' => '<p>Konten belum diisi.</p>']
            );
        }

        // Filter out Struktur Organisasi — shown as a separate special card
        $profils = Profil::where('slug', '!=', 'struktur-organisasi')->get();
        $strukturs = Struktur::orderBy('parent_id')->orderBy('order')->get();
        $strukturCount = $strukturs->count();

        return view('admin.profil.index', compact('profils', 'strukturs', 'strukturCount'));
    }

    public function edit(Profil $profil)
    {
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request, Profil $profil)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($profil->image) {
                Storage::disk('public')->delete($profil->image);
            }
            $validated['image'] = $request->file('image')->store('profil', 'public');
        }

        $profil->update($validated);

        return redirect()->route('admin.profil.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
