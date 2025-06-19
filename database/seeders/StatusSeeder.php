<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['to_do', 'in_progress', 'done'];

        foreach ($statuses as $name) {
            Status::query()->firstOrCreate(['name' => $name]);
        }
    }
}
