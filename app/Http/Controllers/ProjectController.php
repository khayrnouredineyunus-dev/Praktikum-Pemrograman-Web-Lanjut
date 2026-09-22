<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:200',
            'stack' => 'required|max:200',
            'deskripsi' => 'required',
        ]);

        Project::create($request->only(['judul', 'stack', 'deskripsi']));

        return redirect()->route('projects');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }
}