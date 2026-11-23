@extends('layouts.app')

@section('title', $project->judul . ' - Portfolio')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="pesan-sukses">{{ session('success') }}</div>
    @endif

    <h1>{{ $project->judul }}</h1>
    <p class="kartu-meta">{{ $project->stack }}</p>

    @if ($project->thumbnail)
        <img class="thumbnail-detail" src="{{ asset('storage/'.$project->thumbnail) }}" alt="Thumbnail {{ $project->judul }}">
    @endif

    <p>{{ $project->deskripsi }}</p>
    @if ($project->link)
    <p><a href="{{ $project->link }}" target="_blank" rel="noopener">Lihat project</a></p>
    @endif

    @if ($project->images->isNotEmpty())
        <h2 class="judul-bagian">Galeri</h2>
        <div class="galeri">
            @foreach ($project->images as $image)
                <figure class="galeri-item">
                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->caption ?: 'Foto galeri '.$project->judul }}">
                    @if ($image->caption)
                        <figcaption>{{ $image->caption }}</figcaption>
                    @endif
                </figure>
            @endforeach
        </div>
    @endif

    @if (auth()->user()?->role === 'admin')
        <div class="aksi">
            <a href="{{ route('projects.edit', $project) }}">Edit project</a>
        </div>
    @endif
</div>
@endsection
