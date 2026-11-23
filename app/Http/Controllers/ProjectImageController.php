<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    private const MAKS_FOTO = 10;

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images'   => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096|dimensions:min_width=800',
        ]);

        $jumlahLama = ProjectImage::where('project_id', $project->id)->count();
        $jumlahBaru = count($request->file('images'));

        if ($jumlahLama + $jumlahBaru > self::MAKS_FOTO) {
            return back()->withErrors([
                'images' => 'Satu project maksimal '.self::MAKS_FOTO.' foto. Saat ini sudah ada '.$jumlahLama.' foto.',
            ]);
        }

        $urutan = (int) ProjectImage::where('project_id', $project->id)->max('sort_order');

        foreach ($request->file('images') as $file) {
            $urutan++;

            $project->images()->create([
                'path'       => $file->store('projects/gallery', 'public'),
                'sort_order' => $urutan,
            ]);
        }

        return back()->with('success', $jumlahBaru.' foto berhasil ditambahkan ke galeri.');
    }

    public function update(Request $request, Project $project, ProjectImage $image)
    {
        abort_if((int) $image->project_id !== (int) $project->id, 404);

        $validated = $request->validate([
            'caption' => 'nullable|string|max:150',
        ]);

        $image->update($validated);

        return back()->with('success', 'Keterangan foto berhasil diperbarui.');
    }

    public function destroy(Project $project, ProjectImage $image)
    {
        abort_if((int) $image->project_id !== (int) $project->id, 404);

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus dari galeri.');
    }
}
