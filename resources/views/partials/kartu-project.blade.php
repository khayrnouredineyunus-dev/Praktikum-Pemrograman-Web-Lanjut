<article class="kartu">
    @if ($project->thumbnail)
        <img class="kartu-thumbnail" src="{{ asset('storage/'.$project->thumbnail) }}" alt="Thumbnail {{ $project->judul }}">
    @endif

    <h2>
        <a href="{{ route('projects.show', $project) }}">{{ $project->judul }}</a>
        @if ($project->status === 'draft')
            <span class="lencana lencana-draft">Draft</span>
        @endif
    </h2>
    <p class="kartu-meta">
        {{ $project->stack }}
        @if ($project->category)
            | {{ $project->category->name }}
        @endif
    </p>
    <p>{{ $project->short_description ?: \Illuminate\Support\Str::limit($project->deskripsi, 110) }}</p>

    @if ($project->technologies->isNotEmpty())
        <div class="lencana-daftar">
            @foreach ($project->technologies as $tek)
                <span class="lencana">{{ $tek->name }}</span>
            @endforeach
        </div>
    @endif

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
