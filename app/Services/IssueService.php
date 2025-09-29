<?php

namespace App\Services;

use App\Repositories\IssueRepositoryInterface;

class IssueService implements IssueServiceInterface
{
    protected $issueRepository;

    public function __construct(IssueRepositoryInterface $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function getAllIssues()
    {
        return $this->issueRepository->getAllIssues();
    }

    public function getIssueById($id)
    {
        return $this->issueRepository->getIssueById($id);
    }

    public function createIssue(array $data)
    {
        return $this->issueRepository->createIssue($data);
    }

    public function updateIssue($id, array $data)
    {
        return $this->issueRepository->updateIssue($id, $data);
    }

    public function deleteIssue($id)
    {
        return $this->issueRepository->deleteIssue($id);
    }
}
