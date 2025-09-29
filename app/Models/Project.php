<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Task[] $tasks
 *
 * @package App\Models
 */
class Project extends Model
{
	protected $table = 'projects';

	protected $casts = [
		'created_by' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
}
