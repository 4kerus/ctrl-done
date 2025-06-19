<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
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
            'project_id'    => Project::inRandomOrder()->first()?->id ?? Project::factory(),
            'assignee_id'   => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title'         => $this->faker->sentence(4),
            'description'   => $this->faker->paragraph(),
            'status_id'     => Status::inRandomOrder()->first()?->id ?? 1,
            'priority_id'   => Priority::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
