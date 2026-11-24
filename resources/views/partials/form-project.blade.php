{{-- Dipakai oleh form tambah dan form edit. $project bernilai null saat membuat project baru. --}}
<div class="form-group">
    <label for="judul">Judul</label>
    <input type="text" id="judul" name="judul" value="{{ old('judul', $project?->judul) }}">
</div>

<div class="form-group">
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">Pilih kategori</option>
        @foreach ($categories as $kat)
            <option value="{{ $kat->id }}" @selected((string) old('category_id', $project?->category_id) === (string) $kat->id)>{{ $kat->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="stack">Stack</label>
    <input type="text" id="stack" name="stack" value="{{ old('stack', $project?->stack) }}">
</div>

<div class="form-group">
    <label>Teknologi</label>
    @php
        $dipilih = old('technologies', $project ? $project->technologies->pluck('id')->all() : []);
    @endphp
    <div class="centang-daftar">
        @foreach ($technologies as $tek)
            <label class="centang">
                <input type="checkbox" name="technologies[]" value="{{ $tek->id }}" @checked(in_array($tek->id, $dipilih))>
                {{ $tek->name }}
            </label>
        @endforeach
    </div>
</div>

<div class="form-group">
    <label for="short_description">Ringkasan singkat</label>
    <input type="text" id="short_description" name="short_description" maxlength="255" value="{{ old('short_description', $project?->short_description) }}">
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $project?->deskripsi) }}</textarea>
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status">
        <option value="draft" @selected(old('status', $project?->status ?? 'draft') === 'draft')>Draft</option>
        <option value="published" @selected(old('status', $project?->status ?? 'draft') === 'published')>Published</option>
    </select>
    <p class="kartu-meta">Hanya project berstatus Published yang tampil untuk pengunjung.</p>
</div>

<div class="form-group">
    <label for="project_date">Tanggal project</label>
    <input type="date" id="project_date" name="project_date" value="{{ old('project_date', $project?->project_date?->format('Y-m-d')) }}">
</div>

<div class="form-group">
    <input type="hidden" name="is_featured" value="0">
    <label class="centang">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project?->is_featured ?? false))>
        Tandai sebagai project unggulan
    </label>
</div>

<div class="form-group">
    <label for="link">Link project</label>
    <input type="url" id="link" name="link" placeholder="https://" value="{{ old('link', $project?->link) }}">
</div>

<div class="form-group">
    <label for="repository_url">Link repository</label>
    <input type="url" id="repository_url" name="repository_url" placeholder="https://" value="{{ old('repository_url', $project?->repository_url) }}">
</div>
