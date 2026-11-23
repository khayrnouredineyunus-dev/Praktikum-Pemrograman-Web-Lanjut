@extends('layouts.app')

@section('title', 'Tambah Project - Portfolio')

@section('content')
<div class="container">
    <h1>Tambah Project Baru</h1>

    @if ($errors->any())
        <ul class="daftar-error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}">
        </div>
        <div class="form-group">
            <label for="stack">Stack</label>
            <input type="text" id="stack" name="stack" value="{{ old('stack') }}">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp">
            <p class="kartu-meta">JPG, PNG, atau WebP. Maksimal 2 MB, minimal 400 x 300 piksel.</p>
        </div>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
