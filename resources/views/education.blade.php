@extends('layouts.app')

@section('title', 'Education - Portfolio')

@section('content')
    <section>
        <h1>Education</h1>

        @forelse ($pendidikan as $item)
            <article class="kartu">
                <h2>{{ $item['jenjang'] }}</h2>
                <p class="kartu-meta">{{ $item['instansi'] }} &middot; {{ $item['tahun'] }}</p>
                <p>{{ $item['catatan'] }}</p>
            </article>
        @empty
            <p>Belum ada data pendidikan.</p>
        @endforelse
    </section>
@endsection
