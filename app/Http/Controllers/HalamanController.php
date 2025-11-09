<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function profil()
    { 
        $data = [
            'nama' => 'Firdaus Syazwana Handyana Putra',
            'nim' => '1234567890',
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
        $data = [
            'nama' => 'Firdaus Syazwana Handyana Putra',
            'email' => 'firdaus20125100@digitechuniversity.ac.id',
            'telepon' => '+62-858-5527-5077'
        ];

        return view('halaman.kontak', $data);
    }
}

