<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @property int $id
 * @property int $project_id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property int $created_by
 * @property Carbon|null $due_date
 * @property int|null $assigned_to
 * @property int|null $group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Group|null $group
 * @property Project $project
 * @property Collection|Group[] $groups
 * @property Collection|Issue[] $issues
 *
 * @package App\Models
 */
class Task extends Model
{
    protected $table = 'tasks';

    protected $casts = [
        'project_id' => 'int',
        'created_by' => 'int',
        'due_date' => 'datetime',
        'assigned_to' => 'int',
        'group_id' => 'int'
    ];

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'created_by',
        'due_date',
        'assigned_to',
        'group_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_tasks')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
