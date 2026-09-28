@extends('layouts.app')

@section('title', 'Edit Post - Portfolio')

@section('content')
<div class="container">
    <h1>Edit Blog Post</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="_token" value="kombinasi-acak-panjang">

        <input type="hidden" name="_method" value="PUT">
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5">{{ old('description', $post->description) }}</textarea>
        </div>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>
@endsection
