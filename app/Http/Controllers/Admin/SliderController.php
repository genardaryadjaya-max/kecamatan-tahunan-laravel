<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:image,video',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'video' => 'nullable|mimes:mp4,mov,avi|max:102400',
            'link' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        // Hanya sertakan field yang benar-benar ada
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'link' => ($validated['link'] ?? null) === 'null' ? null : ($validated['link'] ?? null),
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        // Handle Video Upload
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('slider', 'public');
        }

        Slider::create($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Video Background berhasil ditambahkan');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'required|in:image,video',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'video' => 'nullable|mimes:mp4,mov,avi|max:102400',
            'link' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'link' => ($validated['link'] ?? null) === 'null' ? null : ($validated['link'] ?? null),
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        // Handle Image Upload
        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        // Handle Video Upload
        if ($request->hasFile('video')) {
            if ($slider->video) {
                Storage::disk('public')->delete($slider->video);
            }
            $data['video'] = $request->file('video')->store('slider', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Video Background berhasil diupdate');
    }

    public function destroy(Slider $slider)
    {
        // Delete files
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        if ($slider->video) {
            Storage::disk('public')->delete($slider->video);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Video Background berhasil dihapus');
    }
}
