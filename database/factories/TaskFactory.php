<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'created_by' => User::factory(),
            'due_date' => $this->faker->optional()->date(),
            'assigned_to' => $this->faker->optional()->randomElement(User::pluck('id')->toArray()),
            'group_id' => $this->faker->optional()->randomElement(Group::pluck('id')->toArray())
        ];
    }
}
