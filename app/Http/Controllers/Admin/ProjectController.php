<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Validation\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:post|min:5|max:20',
            'content' => 'required|string',
            'image' => 'nullable|url',
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => "Esiste già un progetto simile $request->title.",
            'title.min' => 'Il titolo deve avere almeno 5 caratteri',
            'title.max' => 'Il titolo non deve superare i 20 caratteri',
            'content.required' => 'Il progetto deve avere un contenuto',
            'image.url' => 'L\'immagine deve essere un link valido',
        ]);


        $data = $request->all();
        $project = new Project();

        $data['slug'] = Str::slug($data['title'], '-');

        if (Arr::exists($data, 'image')) {
            Storage::put('', $data['image']);
        }

        $project->fill($data);

        $project->save();

        return to_route('admin.projects.show', $project->id)
            ->with('type', 'success')
            ->with('New project created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('project', $data['image']);
            $data['image'] = $img_url;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')
            ->with('type', 'danger')
            ->with('msg', "Il progetto '$project->title' è stato eliminato correttamente");
    }
}
