<?php

namespace App\Repositories;

use App\Models\Issue;

class IssueRepository implements IssueRepositoryInterface
{
    public function getAllIssues()
    {
        return Issue::with(['assignedUser', 'task'])->paginate(9);
    }

    public function getIssueById($id)
    {
        return Issue::findOrFail($id);
    }

    public function createIssue(array $data)
    {
        return Issue::create($data);
    }

    public function updateIssue($id, array $data)
    {
        $issue = Issue::findOrFail($id);
        $issue->update($data);
        return $issue;
    }

    public function deleteIssue($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
    }
}
