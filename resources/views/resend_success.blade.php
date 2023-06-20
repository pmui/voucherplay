@extends('layouts.storefront')
@section('content')
    <div class="container my-4 text-center">
        <h4 class="mt-5">Email Berhasil dikirim!.</h4>
        <p>Periksa folder spam jika emial tidak ditemukan di kotakmasuk.</p>
        <p class="mt-2"><a href="{{ route('home') }}">Kembali ke halamanan utaman</a></p>
    </div>
@endsection
