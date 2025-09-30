<?php

namespace App\Services;

use App\Repositories\GroupRepositoryInterface;

class GroupService implements GroupServiceInterface
{
    protected $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function getAllGroups()
    {
        return $this->groupRepository->getAllGroups();
    }

    public function getGroupById($id)
    {
        return $this->groupRepository->getGroupById($id);
    }

    public function createGroup(array $data)
    {
        return $this->groupRepository->createGroup($data);
    }

    public function updateGroup($id, array $data)
    {
        return $this->groupRepository->updateGroup($id, $data);
    }

    public function deleteGroup($id)
    {
        return $this->groupRepository->deleteGroup($id);
    }
}

;

