<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Services\GroupServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupServiceInterface $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        $groups = $this->groupService->getAllGroups();
        $groups = Group::collection($groups);
        return Inertia::render('Groups/Index', [
                'groups' => $groups
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $data = $request->all();
        $this->groupService->createGroup($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        $group = $this->groupService->getGroupById($id);
        return Inertia::render('Groups/Show', [
                'group' => $group
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $data = $request->all();
        $this->groupService->updateGroup($id, $data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $this->groupService->deleteGroup($id);
        return redirect()->back();
    }
}
