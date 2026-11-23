@extends('layouts.app')

@section('title', 'Edit ' . $project->judul . ' - Portfolio')

@section('content')
<div class="container">
    <h1>Edit Project</h1>

    @if (session('success'))
        <div class="pesan-sukses">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <ul class="daftar-error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $project->judul) }}">
        </div>
        <div class="form-group">
            <label for="stack">Stack</label>
            <input type="text" id="stack" name="stack" value="{{ old('stack', $project->stack) }}">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $project->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            @if ($project->thumbnail)
                <img class="thumbnail-edit" src="{{ asset('storage/'.$project->thumbnail) }}" alt="Thumbnail {{ $project->judul }}">
                <p class="kartu-meta">Pilih file baru hanya jika thumbnail ingin diganti.</p>
            @endif
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp">
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>

    <h2 class="judul-bagian">Galeri Foto</h2>
    <p class="kartu-meta">Maksimal 10 foto per project, lebar minimal 800 piksel, maksimal 4 MB per file.</p>

    <form action="{{ route('projects.images.store', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="images">Tambah foto (boleh pilih lebih dari satu)</label>
            <input type="file" id="images" name="images[]" multiple accept="image/jpeg,image/png,image/webp">
        </div>
        <button type="submit">Upload ke Galeri</button>
    </form>

    @if ($project->images->isNotEmpty())
        <div class="galeri">
            @foreach ($project->images as $image)
                <figure class="galeri-item">
                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->caption ?: 'Foto galeri '.$project->judul }}">

                    <form action="{{ route('projects.images.update', [$project, $image]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="caption" value="{{ $image->caption }}" placeholder="Keterangan foto" maxlength="150">
                        <button type="submit">Simpan</button>
                    </form>

                    <form action="{{ route('projects.images.destroy', [$project, $image]) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="tombol-bahaya">Hapus</button>
                    </form>
                </figure>
            @endforeach
        </div>
    @else
        <p>Belum ada foto di galeri.</p>
    @endif

    <div class="aksi">
        <a href="{{ route('projects.show', $project->id) }}">Lihat halaman project</a>
    </div>
</div>
@endsection
