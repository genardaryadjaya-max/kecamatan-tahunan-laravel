<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PotensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potensis = Potensi::latest()->paginate(20);
        return view('admin.potensi.index', compact('potensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ['pertanian', 'industri', 'wisata', 'peternakan'];
        return view('admin.potensi.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

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

        $validated['is_active'] = $request->has('is_active');

        Potensi::create($validated);

        return redirect()->route('admin.potensi.index')
            ->with('success', 'Potensi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Potensi $potensi)
    {
        return view('admin.potensi.show', compact('potensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Potensi $potensi)
    {
        $categories = ['pertanian', 'industri', 'wisata', 'peternakan'];
        return view('admin.potensi.edit', compact('potensi', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Potensi $potensi)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        // Generate slug if name changed
        if ($validated['name'] !== $potensi->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($potensi->image) {
                Storage::disk('public')->delete($potensi->image);
            }
            $validated['image'] = $request->file('image')->store('potensi', 'public');
        }

        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            // Keep existing gallery or start fresh
            $existingGallery = $potensi->gallery ? json_decode($potensi->gallery, true) : [];

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('potensi/gallery', 'public');
            }

            // Merge with existing
            $validated['gallery'] = json_encode(array_merge($existingGallery, $galleryPaths));
        }

        $validated['is_active'] = $request->has('is_active');

        $potensi->update($validated);

        return redirect()->route('admin.potensi.index')
            ->with('success', 'Potensi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Potensi $potensi)
    {
        // Delete main image
        if ($potensi->image) {
            Storage::disk('public')->delete($potensi->image);
        }

        // Delete gallery images
        if ($potensi->gallery) {
            $gallery = json_decode($potensi->gallery, true);
            foreach ($gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $potensi->delete();

        return redirect()->route('admin.potensi.index')
            ->with('success', 'Potensi berhasil dihapus!');
    }

    /**
     * Delete a single gallery image
     */
    public function deleteGalleryImage(Request $request, Potensi $potensi)
    {
        $imagePath = $request->input('image');

        if ($potensi->gallery) {
            $gallery = json_decode($potensi->gallery, true);

            // Remove the image from array
            $gallery = array_filter($gallery, function ($img) use ($imagePath) {
                return $img !== $imagePath;
            });

            // Delete from storage
            Storage::disk('public')->delete($imagePath);

            // Update database
            $potensi->update(['gallery' => json_encode(array_values($gallery))]);
        }

        return response()->json(['success' => true]);
    }
}
