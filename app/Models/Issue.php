<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Issue
 *
 * @property int $id
 * @property int|null $task_id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property Carbon|null $due_date
 * @property int $created_by
 * @property int|null $assigned_to
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Task|null $task
 *
 * @package App\Models
 */
class Issue extends Model
{
    protected $table = 'issues';

    protected $casts = [
        'task_id' => 'int',
        'due_date' => 'datetime',
        'created_by' => 'int',
        'assigned_to' => 'int'
    ];

    protected $fillable = [
        'task_id',
        'title',
        'description',
        'status',
        'due_date',
        'created_by',
        'assigned_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
