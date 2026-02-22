<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class KontakController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('group', ['contact', 'general', 'social_media'])
            ->get()
            ->keyBy('key');

        return view('public.kontak', compact('settings'));
    }
}
