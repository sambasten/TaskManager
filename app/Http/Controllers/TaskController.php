<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Http\Requests\StoreTaskRequest;

/**
 * Class TaskController handles all CRUD operations for the Task model
 * 
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //rearrange tasks by priority ascending
        $tasks = Task::all()->sortByAsc('priority');
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create', ['projects' => Project::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = new Task();
            $task->name = $request->name;
            $task->project_id = intval($request->project);
            $task->priority = intval($request->priority);
            $task->save();
            return redirect()->route('projects.show', ['project' => $task->project->id])->with('success', 'Task created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('tasks.create')->with('error', 'Task creation failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\StoreTaskRequest $request
     * @param  Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $taskUpdateData = [
            'name' => $request->name ?? $task->name,
            'project_id' => $task->project_id,
            'priority' => intval($request->priority) ?? $task->priority,
        ];
        

        try {
            $task->update($taskUpdateData);

            //return json response if request is ajax 
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Task updated successfully',
                    'data' => $task
                ]);
            }
            return redirect()->route('projects.show', ['project' => $task->project->id])->with('success', 'Task updated successfully');
        } catch (Exception $e) {
            $error = $e->getMessage();
            Log::error($error);

            return back()->with('error', $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return back()->with('success', 'Task deleted successfully');
        } catch (Exception $e) {
            $error = $e->getMessage();
            Log::error($error);

            return back()->with('error', $error);
        }
    }
}
