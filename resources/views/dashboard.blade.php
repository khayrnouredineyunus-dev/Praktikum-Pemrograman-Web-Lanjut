@extends('layouts.app')

@section('title', 'Dashboard - Portfolio')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p class="kartu-meta">Ringkasan data portfolio. Semua angka dihitung langsung di database.</p>

    <div class="statistik">
        <x-stat-card label="Total Post" :value="$stats['posts']" color="biru" />
        <x-stat-card label="Published" :value="$stats['published']" color="hijau" />
        <x-stat-card label="Draft" :value="$stats['draft']" color="kuning" />
        <x-stat-card label="Total Project" :value="$stats['projects']" color="aksen" />
        <x-stat-card label="Foto Galeri" :value="$stats['images']" color="aksen" />
        <x-stat-card label="Pengguna" :value="$stats['users']" />
    </div>

    <h2 class="judul-bagian">Project dengan foto terbanyak</h2>
    @forelse ($topProjects as $project)
        <article class="kartu">
            <h2><a href="{{ route('projects.show', $project->id) }}">{{ $project->judul }}</a></h2>
            <p class="kartu-meta">{{ $project->images_count }} foto di galeri</p>
        </article>
    @empty
        <p>Belum ada project.</p>
    @endforelse

    <h2 class="judul-bagian">Post terbaru</h2>
    @forelse ($latestPosts as $post)
        <article class="kartu">
            <h2>{{ $post->title }}</h2>
            <p class="kartu-meta">Status: {{ $post->status }} | Dibuat: {{ $post->created_at?->format('d M Y') }}</p>
        </article>
    @empty
        <p>Belum ada post.</p>
    @endforelse
</div>
@endsection
