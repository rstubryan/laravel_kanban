<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository implements GroupRepositoryInterface
{
    public function getAllGroups()
    {
        return Group::paginate(9);
    }

    public function getGroupById($id)
    {
        return Group::findOrFail($id);
    }

    public function createGroup(array $data)
    {
        return Group::create($data);
    }

    public function updateGroup($id, array $data)
    {
        $group = Group::findOrFail($id);
        $group->update($data);
        return $group;
    }

    public function deleteGroup($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
    }
}
