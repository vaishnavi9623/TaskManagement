<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskNote;
use Illuminate\Database\Seeder;

class TaskNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        TaskNote::insert([
            [
                'task_id' => $tasks[array_rand($tasks)],
                'user_id' => $users[array_rand($users)],
                'note' => 'Ensure to use middleware for API authentication.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_id' => $tasks[array_rand($tasks)],
                'user_id' => $users[array_rand($users)],
                'note' => 'Use Eloquent relationships efficiently for data retrieval.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_id' => $tasks[array_rand($tasks)],
                'user_id' => $users[array_rand($users)],
                'note' => 'Optimize database queries with indexing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
