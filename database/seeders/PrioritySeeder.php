<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = ['low', 'medium', 'epic', 'urgent'];

        foreach ($priorities as $name) {
            Priority::query()->firstOrCreate(['name' => $name]);
        }
    }
}
