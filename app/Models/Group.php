<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Task[] $tasks
 *
 * @package App\Models
 */
class Group extends Model
{
	protected $table = 'groups';

	protected $fillable = [
		'name',
		'description'
	];

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
}
