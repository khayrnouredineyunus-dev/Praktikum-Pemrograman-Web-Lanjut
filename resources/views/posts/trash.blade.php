@extends('layouts.app')

@section('title', 'Trash - Portfolio')

@section('content')
<div class="container">
    <h1>Trash</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><a href="{{ route('posts.index') }}">Kembali ke daftar post</a></p>

    @forelse ($posts as $post)
        <article class="kartu">
            <h2>{{ $post->title }}</h2>
            <p class="kartu-meta">Dihapus: {{ $post->deleted_at }}</p>

            <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PATCH')
                <button type="submit">Restore</button>
            </form>

            <form action="{{ route('posts.force-destroy', $post->id) }}" method="POST" style="display:inline"
                    onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan.')">
                @csrf
                @method('DELETE')
                <button type="submit">Permanent Delete</button>
            </form>
        </article>
    @empty
        <p>Trash kosong.</p>
    @endforelse
</div>
@endsection