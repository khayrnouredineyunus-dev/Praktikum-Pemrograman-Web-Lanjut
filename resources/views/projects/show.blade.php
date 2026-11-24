@extends('layouts.app')

@section('title', $project->judul . ' - Portfolio')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="pesan-sukses">{{ session('success') }}</div>
    @endif

    <h1>
        {{ $project->judul }}
        @if ($project->status === 'draft')
            <span class="lencana lencana-draft">Draft</span>
        @endif
    </h1>
    <p class="kartu-meta">
        {{ $project->stack }}
        @if ($project->category)
            | {{ $project->category->name }}
        @endif
        @if ($project->project_date)
            | {{ $project->project_date->format('d M Y') }}
        @endif
    </p>

    @if ($project->technologies->isNotEmpty())
        <div class="lencana-daftar">
            @foreach ($project->technologies as $tek)
                <a class="lencana" href="{{ route('projects', ['technology' => $tek->slug]) }}">{{ $tek->name }}</a>
            @endforeach
        </div>
    @endif

    @if ($project->thumbnail)
        <img class="thumbnail-detail" src="{{ asset('storage/'.$project->thumbnail) }}" alt="Thumbnail {{ $project->judul }}">
    @endif

    <p>{{ $project->deskripsi }}</p>
    @if ($project->link)
        <p><a href="{{ $project->link }}" target="_blank" rel="noopener">Lihat project</a></p>
    @endif
    @if ($project->repository_url)
        <p><a href="{{ $project->repository_url }}" target="_blank" rel="noopener">Lihat repository</a></p>
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

    <div class="aksi">
        <a href="{{ route('projects') }}">Kembali ke daftar project</a>
        @if (auth()->user()?->role === 'admin')
            <a href="{{ route('projects.edit', $project) }}">Edit project</a>
        @endif
    </div>
</div>
@endsection
