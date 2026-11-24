<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    private const OPSI_URUT = [
        'terbaru' => 'Terbaru',
        'terlama' => 'Terlama',
        'az'      => 'Judul A-Z',
        'tanggal' => 'Tanggal project',
    ];

    public function index(Request $request)
    {
        $admin = auth()->user()?->role === 'admin';

        $cari      = $this->teks($request, 'search');
        $kategori  = $this->teks($request, 'category');
        $teknologi = $this->teks($request, 'technology');
        $urut      = $this->teks($request, 'sort');

        // Pengunjung hanya melihat project published. Admin boleh memilih status.
        $status = $admin ? $this->teks($request, 'status') : 'published';
        if (! in_array($status, ['published', 'draft', 'semua'], true)) {
            $status = 'published';
        }

        $query = Project::with('category', 'technologies')
            ->when($status !== 'semua', fn ($q) => $q->where('status', $status))
            ->when($cari, fn ($q, $kata) => $q->where(function ($w) use ($kata) {
                $w->where('judul', 'like', "%{$kata}%")
                  ->orWhere('stack', 'like', "%{$kata}%")
                  ->orWhere('short_description', 'like', "%{$kata}%")
                  ->orWhere('deskripsi', 'like', "%{$kata}%");
            }))
            ->when($kategori, fn ($q, $slug) => $q->whereHas(
                'category',
                fn ($w) => $w->where('slug', $slug)
            ))
            ->when($teknologi, fn ($q, $slug) => $q->whereHas(
                'technologies',
                fn ($w) => $w->where('slug', $slug)
            ));

        if ($urut === 'judul') {
            $urut = 'az';
        }
        if (! array_key_exists($urut, self::OPSI_URUT)) {
            $urut = 'terbaru';
        }

        // Kolom id dipakai sebagai pembeda kedua supaya urutan tetap stabil antarhalaman.
        switch ($urut) {
            case 'terlama':
                $query->oldest()->orderBy('id');
                break;
            case 'az':
                $query->orderBy('judul')->orderBy('id');
                break;
            case 'tanggal':
                $query->orderByDesc('project_date')->orderByDesc('id');
                break;
            default:
                $query->latest()->orderByDesc('id');
        }

        $projects = $query->paginate(9)->withQueryString();

        $categories   = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();
        $opsiUrut     = self::OPSI_URUT;

        $adaFilter = $cari !== '' || $kategori !== '' || $teknologi !== ''
            || $request->filled('sort') || $status !== 'published';

        return view('projects', compact(
            'projects',
            'categories',
            'technologies',
            'opsiUrut',
            'cari',
            'kategori',
            'teknologi',
            'urut',
            'status',
            'admin',
            'adaFilter'
        ));
    }

    public function create()
    {
        return view('projects.create', [
            'categories'   => Category::orderBy('name')->get(),
            'technologies' => Technology::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->aturan());

        $technologyIds = $validated['technologies'] ?? [];
        unset($validated['technologies']);

        $validated['slug']        = $this->buatSlug($validated['judul']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project = Project::create($validated);
        $project->technologies()->attach($technologyIds);

        return redirect()->route('projects')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        // Project draft hanya boleh dibuka admin. Pengunjung mendapat 404.
        abort_if(
            $project->status !== 'published' && auth()->user()?->role !== 'admin',
            404
        );

        $project->load('category', 'technologies', 'images');

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load('images', 'technologies');

        return view('projects.edit', [
            'project'      => $project,
            'categories'   => Category::orderBy('name')->get(),
            'technologies' => Technology::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate($this->aturan($project));

        $technologyIds = $validated['technologies'] ?? [];
        unset($validated['technologies']);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $pathBaru = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');

            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $validated['thumbnail'] = $pathBaru;
        } else {
            unset($validated['thumbnail']);
        }

        $project->update($validated);
        $project->technologies()->sync($technologyIds);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $project->delete();

        return redirect()->route('projects')
            ->with('deleted', 'Project beserta semua filenya berhasil dihapus.');
    }

    private function aturan(?Project $project = null): array
    {
        return [
            'judul'             => ['required', 'max:200', Rule::unique('projects', 'judul')->ignore($project?->id)],
            'category_id'       => 'required|exists:categories,id',
            'stack'             => 'required|max:200',
            'short_description' => 'nullable|max:255',
            'deskripsi'         => 'required',
            'status'            => 'required|in:draft,published',
            'project_date'      => 'nullable|date',
            'is_featured'       => 'nullable|boolean',
            'link'              => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',
            'technologies'      => 'nullable|array',
            'technologies.*'    => 'exists:technologies,id',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ];
    }

    private function buatSlug(string $judul): string
    {
        $dasar = Str::slug($judul) ?: 'project';
        $slug  = $dasar;
        $nomor = 2;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $dasar.'-'.$nomor++;
        }

        return $slug;
    }

    private function teks(Request $request, string $kunci): string
    {
        $nilai = $request->query($kunci);

        return is_string($nilai) ? trim($nilai) : '';
    }
}
