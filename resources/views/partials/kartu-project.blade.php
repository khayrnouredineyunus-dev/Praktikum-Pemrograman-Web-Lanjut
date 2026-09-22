<article class="kartu">
    <h2><a href="{{ route('projects.show', $project['id']) }}">{{ $project['judul'] }}</a></h2>
    <p class="kartu-meta">{{ $project['stack'] }}</p>
    <p>{{ $project['deskripsi'] }}</p>
</article>