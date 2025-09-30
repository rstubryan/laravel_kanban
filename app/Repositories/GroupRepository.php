<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository implements GroupRepositoryInterface
{
    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function getAllGroups()
    {
        return $this->model->all();
    }

    public function getGroupById($id)
    {
        return $this->model->find($id);
    }

    public function createGroup(array $data)
    {
        return $this->model->create($data);
    }

    public function updateGroup($id, array $data)
    {
        $group = $this->model->find($id);
        if ($group) {
            $group->update($data);
            return $group;
        }
        return null;
    }

    public function deleteGroup($id)
    {
        $group = $this->model->find($id);
        if ($group) {
            return $group->delete();
        }
        return false;
    }
}
