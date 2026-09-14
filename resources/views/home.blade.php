@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
    <section class="hero">
        <p class="hero-sapa">Halo, saya</p>
        <h1>{{ $nama }}</h1>
        <p class="hero-peran">{{ $peran }}</p>
        <p>{{ $ringkas }}</p>

        <a href="{{ route('projects') }}" class="tombol">Lihat Projects</a>
    </section>
@endsection

@push('scripts')
    <script>console.log('halaman home dimuat');</script>
@endpush
