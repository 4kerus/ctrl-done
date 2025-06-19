<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создание одного пользователя
        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Один проект, связанный с этим пользователем
        $project = \App\Models\Project::factory()
            ->for($user)
            ->create();

        // Запускаем сидеры для статусов и приоритетов
        $this->call([
            \Database\Seeders\StatusSeeder::class,
            \Database\Seeders\PrioritySeeder::class,
        ]);

        // Получаем случайные статус и приоритет
        $statusIds = \App\Models\Status::pluck('id');
        $priorityIds = \App\Models\Priority::pluck('id');

        // Создаём задачи для проекта с случайными статусами и приоритетами
        \App\Models\Task::factory(10)->create([
            'project_id' => $project->id,
            'assignee_id' => $user->id,
            'status_id' => fake()->randomElement($statusIds),
            'priority_id' => fake()->randomElement($priorityIds),
        ]);
    }
}
