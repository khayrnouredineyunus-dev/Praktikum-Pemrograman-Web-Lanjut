@extends('layouts.app')

@section('title', $post->title . ' - Portfolio')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p class="kartu-meta">Diperbarui: {{ $post->updated_at ?? '-' }}</p>
    <p>{{ $post->description }}</p>

    <a href="{{ route('posts.edit', $post->id) }}">Edit</a> |
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline"
        onsubmit="return confirm('Yakin ingin menghapus post ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
    </form>
</div>
@endsection