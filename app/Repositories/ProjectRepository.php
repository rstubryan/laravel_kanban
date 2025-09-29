<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects()
    {
        return Project::with('user')->paginate(9);
    }

    public function getProjectById($id)
    {
        return Project::findOrFail($id);
    }

    public function createProject(array $data)
    {
        return Project::create($data);
    }

    public function updateProject($id, array $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
    }
}
