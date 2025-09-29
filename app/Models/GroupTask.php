<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupTask
 * 
 * @property int $id
 * @property int $group_id
 * @property int $task_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Group $group
 * @property Task $task
 *
 * @package App\Models
 */
class GroupTask extends Model
{
	protected $table = 'group_tasks';

	protected $casts = [
		'group_id' => 'int',
		'task_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'task_id'
	];

	public function group()
	{
		return $this->belongsTo(Group::class);
	}

	public function task()
	{
		return $this->belongsTo(Task::class);
	}
}
