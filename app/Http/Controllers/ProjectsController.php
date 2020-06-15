<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    //
    public function index(Request $request)
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        auth()->user()->projects()->create($attributes);
        // Redirect
        return redirect('/projects');
    }

    public function show(Project $project)
    {
        if (auth()->id() != $project->owner_id) {
            abort(403);
        }
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }
}
