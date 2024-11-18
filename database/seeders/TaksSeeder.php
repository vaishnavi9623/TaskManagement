<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TaksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task')->insert([
            [
                'name' => 'Task ' . Str::random(5),
                'description' => 'Description for task 1',
                'starttime' => now(),
                'endtime' => now()->addHours(1),
                'status' => 'pending',
                'assign_to' => 1, // Ensure the user with ID 1 exists
            ],
            [
                'name' => 'Task ' . Str::random(5),
                'description' => 'Description for task 2',
                'starttime' => now(),
                'endtime' => now()->addHours(2),
                'status' => 'completed',
                'assign_to' => 2, // Ensure the user with ID 2 exists
            ],
            [
                'name' => 'Task ' . Str::random(5),
                'description' => 'Description for task 3',
                'starttime' => now(),
                'endtime' => now()->addHours(3),
                'status' => 'pending',
                'assign_to' => 3, // Ensure the user with ID 3 exists
            ],
        ]);
    }
}
