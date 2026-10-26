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
        <input type="hidden" name="status" value="{{ request('status') }}">
        <input type="hidden" name="per_page" value="{{ $posts->perPage() }}">
        <button type="submit">Cari</button>
    </form>

    <p>
        <a href="{{ route('posts.index') }}">Semua</a> |
        <a href="{{ route('posts.index', ['status' => 'published']) }}">Published</a>
        <a href="{{ route('posts.trash') }}">Trash</a>
    </p>

    <p>
        Per halaman:
        @foreach ([5, 10, 25] as $size)
            @if ($posts->perPage() == $size)
                <strong>{{ $size }}</strong>
            @else
                <a href="{{ route('posts.index', array_merge(request()->except('page'), ['per_page' => $size])) }}">{{ $size }}</a>
            @endif
            @if (! $loop->last) | @endif
        @endforeach
    </p>

    @forelse ($posts as $post)
        <article class="kartu">
            <h2>
                {{ $posts->firstItem() + $loop->index }}.
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </h2>
            <p class="kartu-meta">Diperbarui: {{ $post->updated_at ?? '-' }}</p>
            <p class="kartu-meta">Status: {{ $post->status }}</p>
        </article>
    @empty
        <p>Tidak ada data.</p>
    @endforelse

    <div class="mt-4 text-sm text-gray-600">
        Halaman : {{ $posts->currentPage() }} <br>
        Jumlah Data : {{ $posts->total() }} <br>
        Data Per Halaman : {{ $posts->perPage() }}
    </div>
    
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection