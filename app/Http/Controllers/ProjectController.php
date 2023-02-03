<?php

namespace App\Http\Controllers;

use App\Models\Project;

/**
 * Class ProjectController represents a controller for the Project model
 * 
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::find($project->id);
        $tasks = $project->tasks;
        //sort tasks by priority ascending
        $tasks = $tasks->sortBy('priority');
        return view('tasks.index', ['tasks' => $tasks]);
    }

}
