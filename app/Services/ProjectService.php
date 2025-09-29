<?php

namespace App\Services;

use App\Repositories\ProjectRepositoryInterface;

class ProjectService implements ProjectServiceInterface
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects()
    {
        return $this->projectRepository->getAllProjects();
    }

    public function getProjectById($id)
    {
        return $this->projectRepository->getProjectById($id);
    }

    public function createProject(array $data)
    {
        return $this->projectRepository->createProject($data);
    }

    public function updateProject($id, array $data)
    {
        return $this->projectRepository->updateProject($id, $data);
    }

    public function deleteProject($id)
    {
        return $this->projectRepository->deleteProject($id);
    }
}
