@extends('layout.main')

@section('title', 'Profil')

@section('content')
    <h2>Profil Saya</h2>
    <ul>
        <li>Nama: {{ $nama }}</li>
        <li>NIM/NPM: {{ $nim }}</li>
        <li>Prodi: {{ $prodi }}</li>
    </ul>
@endsection
