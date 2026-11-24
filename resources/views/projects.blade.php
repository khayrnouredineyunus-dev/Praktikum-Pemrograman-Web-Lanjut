@extends('layouts.app')

@section('title', 'Projects - Portfolio')

@section('content')
    <section>
        <h1>Projects</h1>

        @if (session('success'))
            <div class="pesan-sukses">{{ session('success') }}</div>
        @endif

        @if (session('deleted'))
            <div class="pesan-hapus">{{ session('deleted') }}</div>
        @endif

        <form action="{{ route('projects') }}" method="GET" class="filter">
            <input type="text" name="search" value="{{ $cari }}" placeholder="Cari judul, stack, atau deskripsi">

            <select name="category" aria-label="Kategori">
                <option value="">Semua kategori</option>
                @foreach ($categories as $kat)
                    <option value="{{ $kat->slug }}" @selected($kategori === $kat->slug)>{{ $kat->name }}</option>
                @endforeach
            </select>

            <select name="technology" aria-label="Teknologi">
                <option value="">Semua teknologi</option>
                @foreach ($technologies as $tek)
                    <option value="{{ $tek->slug }}" @selected($teknologi === $tek->slug)>{{ $tek->name }}</option>
                @endforeach
            </select>

            <select name="sort" aria-label="Urutkan">
                @foreach ($opsiUrut as $nilai => $label)
                    <option value="{{ $nilai }}" @selected($urut === $nilai)>{{ $label }}</option>
                @endforeach
            </select>

            @if ($admin)
                <select name="status" aria-label="Status">
                    <option value="published" @selected($status === 'published')>Published</option>
                    <option value="draft" @selected($status === 'draft')>Draft</option>
                    <option value="semua" @selected($status === 'semua')>Semua status</option>
                </select>
            @endif

            <button type="submit">Cari</button>
        </form>

        <p class="hasil-info">
            {{ $projects->total() }} project ditemukan
            @if ($adaFilter)
                | <a href="{{ route('projects') }}">Reset</a>
            @endif
        </p>

        <div class="grid-project">
            @forelse ($projects as $project)
                @include('partials.kartu-project', ['project' => $project])
            @empty
                <p class="kosong">Tidak ada project yang cocok.</p>
            @endforelse
        </div>

        {{ $projects->links() }}

        <p><a href="{{ route('projects.create') }}">+ Tambah Project</a></p>
    </section>
@endsection
