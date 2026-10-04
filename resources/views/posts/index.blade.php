@extends('layouts.app')

@section('title', 'Blog Posts - Portfolio')

@section('content')
<div class="container">
    <h1>Blog Posts</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><a href="{{ route('posts.create') }}">Create New Post</a></p>
    
    <form action="{{ route('posts.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul post">
        <button type="submit">Cari</button>
    </form>

    @forelse ($posts as $post)
        <article class="kartu">
            <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
            <p class="kartu-meta">Diperbarui: {{ $post->updated_at ?? '-' }}</p>
        </article>
    @empty
        <p>Tidak ada data.</p>
    @endforelse
</div>
@endsection