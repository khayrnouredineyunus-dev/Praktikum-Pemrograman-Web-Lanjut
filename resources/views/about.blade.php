@extends('layouts.app')

@section('title', 'About - Portfolio')

@section('content')
    <section>
        <h1>About</h1>

        <p>
            Saya {{ $nama }}, mahasiswa program studi D-IV Teknologi Rekayasa Perangkat Lunak,
            Sekolah Vokasi Universitas Gadjah Mada. Saat ini saya berdomisili di {{ $asal }}.
        </p>

        @isset($minat)
            <h2>Bidang yang diminati</h2>
            <ul class="daftar">
                @foreach ($minat as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @endisset
    </section>
@endsection
