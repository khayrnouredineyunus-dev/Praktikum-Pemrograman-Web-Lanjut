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

        @include('partials.form-project', ['project' => null])

        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp">
            <p class="kartu-meta">JPG, PNG, atau WebP. Maksimal 2 MB, minimal 400 x 300 piksel.</p>
        </div>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
