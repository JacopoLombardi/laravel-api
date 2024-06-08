<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET['stringSearch'])){
            $projects = Project::where('title', 'LIKE', '%' . $_GET['stringSearch'] . '%')->get();
            $projects_count = Project::where('title', 'LIKE', '%' . $_GET['stringSearch'] . '%')->count();
        }else{
            $projects = Project::all();
            $projects_count = Project::count();
        }

        return view('admin.projects.index', compact('projects', 'projects_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        $exist = Project::where('title', $request->title)->first();
        if($exist){
            return redirect()->route('admin.projects.create')->with('error', 'Progetto già esistente');
        }else{
            $form_data['slug'] = Helper::createSlug($form_data['title'], Project::class);

            $new_project = new Project();
            $new_project->fill($form_data);
            $new_project->save();

            if(array_key_exists('technologies', $form_data)){
                $new_project->technologies()->attach($form_data['technologies']);
            }

            return redirect()->route('admin.projects.show', $new_project)->with('success', 'Progetto aggiunto correttamente');
        }
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
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        $project->update($form_data);

        if(array_key_exists('technologies', $form_data)){
            $project->technologies()->sync($form_data['technologies']);
        }else{
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)->with('success', 'Progetto modificato correttamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
