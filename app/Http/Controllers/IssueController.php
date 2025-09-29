<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Services\IssueServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IssueController extends Controller
{
    protected $issueService;

    public function __construct(IssueServiceInterface $issueService)
    {
        $this->issueService = $issueService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TaskResource $taskResource)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $issues = $this->issueService->getAllIssues();
        $issues = TaskResource::collection($issues);

        return Inertia::render('Issues/Index', [
            'issues' => $issues,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->all();
        $data['created_by'] = auth()->id();
        $this->issueService->createIssue($data);

        return redirect()->back()->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $issue = $this->issueService->getIssueById($id);
        if (!$issue) {
            return redirect()->back()->with('error', 'Issue not found.');
        }

        return Inertia::render('Issues/Show', [
            'issue' => $issue
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->all();
        $this->issueService->updateIssue($id, $data);

        return redirect()->back()->with('success', 'Issue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->issueService->deleteIssue($id);

        return redirect()->back()->with('success', 'Issue deleted successfully.');
    }
}
