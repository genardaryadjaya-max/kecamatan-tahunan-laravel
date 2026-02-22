<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(20);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        $categories = ['pengumuman', 'informasi', 'kegiatan', 'berita'];
        return view('admin.berita.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('berita', 'public');
        }

        $isPublished = $request->has('is_published');
        $validated['is_published'] = $isPublished;
        $validated['published_at'] = $isPublished ? ($request->published_at ?? now()) : null;

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $categories = ['pengumuman', 'informasi', 'kegiatan', 'berita'];
        return view('admin.berita.edit', compact('berita', 'categories'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        if ($validated['title'] !== $berita->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }
            $validated['image'] = $request->file('image')->store('berita', 'public');
        }

        $isPublished = $request->has('is_published');
        $validated['is_published'] = $isPublished;
        if ($isPublished && !$berita->published_at) {
            $validated['published_at'] = $request->published_at ?? now();
        } elseif (!$isPublished) {
            $validated['published_at'] = null;
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->image) {
            Storage::disk('public')->delete($berita->image);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function scrape(Request $request)
    {
        $url = $request->query('url');
        if (!$url) {
            return redirect()->back()->with('error', 'URL tidak valid.');
        }

        try {
            $html = @file_get_contents($url);
            if (!$html) {
                return redirect()->back()->with('error', 'Gagal mengambil data dari URL (mungkin diblokir oleh target).');
            }

            // Parse Meta Tags (og:title, og:description, og:image)
            $title = '';
            $description = '';
            $image_url = '';

            if (preg_match('/<meta property="og:title" content="([^"]+)"/i', $html, $matches)) {
                $title = html_entity_decode($matches[1]);
            } elseif (preg_match('/<title[^>]*>([^<]+)<\/title>/i', $html, $matches)) {
                $title = html_entity_decode($matches[1]);
            }

            if (preg_match('/<meta property="og:description" content="([^"]+)"/i', $html, $matches)) {
                $description = html_entity_decode($matches[1]);
            } elseif (preg_match('/<meta name="description" content="([^"]+)"/i', $html, $matches)) {
                $description = html_entity_decode($matches[1]);
            }

            if (preg_match('/<meta property="og:image" content="([^"]+)"/i', $html, $matches)) {
                $image_url = html_entity_decode($matches[1]);
            }

            // Save image temporarily to storage if possible
            $saved_image_path = null;
            if ($image_url) {
                try {
                    $image_contents = @file_get_contents($image_url);
                    if ($image_contents) {
                        $filename = 'scraped_' . time() . '.jpg';
                        Storage::disk('public')->put('berita/' . $filename, $image_contents);
                        $saved_image_path = 'berita/' . $filename;
                    }
                } catch (\Exception $e) {
                    // Ignore image DL failure
                }
            }

            // Save as draft Berita
            $newBerita = Berita::create([
                'title' => $title ?: 'Scraped Article',
                'slug' => Str::slug($title ?: 'Scraped Article ' . time()),
                'category' => 'berita',
                'content' => $description ? '<p>' . $description . '</p><p>Sumber: <a href="'.$url.'">'.$url.'</a></p>' : '<p>Sumber: <a href="'.$url.'">'.$url.'</a></p>',
                'excerpt' => Str::limit($description, 200),
                'image' => $saved_image_path,
                'is_published' => false,
                'created_by' => auth()->id(),
            ]);

            return redirect()->route('admin.berita.edit', $newBerita->slug)
                ->with('success', 'Berhasil melakukan scrape. Silakan lengkapi dan publish artikel ini!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat scraping: ' . $e->getMessage());
        }
    }
}
