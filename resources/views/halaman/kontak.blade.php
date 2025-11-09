@extends('layout.main')

@section('title', 'Kontak')

@section('content')
    <h2>Kontak Saya</h2>
    <ul>
        <li>Nama: {{ $nama }}</li>
        <li>Email: {{ $email }}</li>
        <li>Telepon: {{ $telepon }}</li>
    </ul>
@endsection
