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
                'assign_to' => 1,
                'category' => 'Deployment',
                'priority' => 'Critical',
                'attachment' => 'deployment_guide.pdf',
                'deadline' => '2024-12-10',
                'recurring_task' => 'none', // Set to none for a non-recurring task
            ],
            [
                'name' => 'Task ' . Str::random(5),
                'description' => 'Description for task 2',
                'starttime' => now(),
                'endtime' => now()->addHours(2),
                'status' => 'completed',
                'assign_to' => 2, 
                'category' => 'Development',
                'priority' => 'High',
                'attachment' => 'design_doc.pdf',
                'deadline' => '2024-12-01',
                'recurring_task' => 'daily', 
            ],
            [
                'name' => 'Task ' . Str::random(5),
                'description' => 'Description for task 3',
                'starttime' => now(),
                'endtime' => now()->addHours(3),
                'status' => 'pending',
                'assign_to' => 3, 
                'category' => 'Testing',
                'priority' => 'Medium',
                'attachment' => 'test_cases.xlsx',
                'deadline' => '2024-12-05',
                'recurring_task' => 'monthly', // Set to monthly
            ],
        ]);
    }
}
