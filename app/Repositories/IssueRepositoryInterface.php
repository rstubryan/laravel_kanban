<?php

namespace App\Repositories;

interface IssueRepositoryInterface
{
    public function getAllIssues();

    public function getIssueById($id);

    public function createIssue(array $data);

    public function updateIssue($id, array $data);

    public function deleteIssue($id);
}
