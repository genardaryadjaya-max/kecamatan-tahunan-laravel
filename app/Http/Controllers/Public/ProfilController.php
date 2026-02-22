<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Struktur;

class ProfilController extends Controller
{
    public function sejarah()
    {
        $profil = Profil::type('sejarah')->first();
        return view('public.profil.sejarah', compact('profil'));
    }

    public function geografis()
    {
        $profil = Profil::type('geografis')->first();
        return view('public.profil.geografis', compact('profil'));
    }

    public function visiMisi()
    {
        $profil = Profil::type('visi-misi')->first();
        return view('public.profil.visi-misi', compact('profil'));
    }

    public function struktur()
    {
        $allStruktur = Struktur::active()->orderBy('order')->get();
        return view('public.profil.struktur', compact('allStruktur'));
    }
}
