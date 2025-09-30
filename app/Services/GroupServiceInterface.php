<?php

namespace App\Services;

interface GroupServiceInterface
{
    public function getAllGroups();

    public function getGroupById($id);

    public function createGroup(array $data);

    public function updateGroup($id, array $data);

    public function deleteGroup($id);
}
