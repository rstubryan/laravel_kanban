<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectServiceInterface;
use Inertia\Inertia;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $projects = $this->projectService->getAllProjects();
        $projects = ProjectResource::collection($projects);
        return Inertia::render('Projects/Index', [
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->projectService->createProject([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $project = $this->projectService->getProjectById($id);
        return Inertia::render('Projects/Show', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->projectService->updateProject($id, [
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->projectService->deleteProject($id);
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }
}
