<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $sosmed = [
            'facebook' => \App\Models\Setting::get('sosmed_facebook'),
            'twitter' => \App\Models\Setting::get('sosmed_twitter'),
            'instagram' => \App\Models\Setting::get('sosmed_instagram'),
            'youtube' => \App\Models\Setting::get('sosmed_youtube'),
        ];
        
        return view('admin.setting.index', compact('sosmed'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'sosmed_facebook' => 'nullable|url',
            'sosmed_twitter' => 'nullable|url',
            'sosmed_instagram' => 'nullable|url',
            'sosmed_youtube' => 'nullable|url',
        ]);

        foreach ($validated as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'sosmed', 'type' => 'url']
            );
        }

        return redirect()->back()->with('success', 'Tautan Sosial berhasil diperbarui.');
    }
}
