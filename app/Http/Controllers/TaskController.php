<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\User;
use App\Services\TaskServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $tasks = $this->taskService->getAllTasks();
        $tasks = TaskResource::collection($tasks);

        $users = User::all(['id', 'name']);
        $projects = Project::all(['id', 'name']);

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'users' => $users,
            'projects' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->validated();
        $data['created_by'] = auth()->id();

        $this->taskService->createTask($data);

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $task = $this->taskService->getTaskById($id);
        $task = new TaskResource($task);
        return Inertia::render('Tasks/Show', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->taskService->updateTask($id, $request->validated());

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->taskService->deleteTask($id);
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
