<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Taskcomment;

class TaskcommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        Taskcomment::insert([
            [
                'task_id' => $tasks[array_rand($tasks)],
                'user_id' => $users[array_rand($users)],
                'comments' => 'This task is almost done, just need final review.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_id' => $tasks[array_rand($tasks)],
                'user_id' => $users[array_rand($users)],
                'comments' => 'Let’s discuss the API versioning strategy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_id' => $tasks[array_rand($tasks)],
                'user_id' => $users[array_rand($users)],
                'comments' => 'Great work! Can we add pagination to the API responses?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
