<article class="kartu">
    @if ($project->thumbnail)
        <img class="kartu-thumbnail" src="{{ asset('storage/'.$project->thumbnail) }}" alt="Thumbnail {{ $project->judul }}">
    @endif

    <h2><a href="{{ route('projects.show', $project->id) }}">{{ $project->judul }}</a></h2>
    <p class="kartu-meta">{{ $project->stack }}</p>
    <p>{{ $project->deskripsi }}</p>

    @if (auth()->user()?->role === 'admin')
        <div class="aksi">
            <a href="{{ route('projects.edit', $project) }}">Edit</a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus project ini beserta semua fotonya?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="tombol-bahaya">Hapus</button>
            </form>
        </div>
    @endif
</article>
