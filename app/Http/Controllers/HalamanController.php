<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function profil()
    { 
        $data = [
            'nama' => 'Firdaus Syazwana Handyana Putra',
            'nidn' => '1234567890',
            'prodi' => 'Informatika'
        ];

        return view('halaman.profil', $data);
    }

    public function galeri()
    {
        return view('halaman.galeri');
    }

    public function kontak()
    {
        return view('halaman.kontak');
    }
}

