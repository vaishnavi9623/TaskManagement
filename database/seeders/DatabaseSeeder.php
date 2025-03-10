<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            TaksSeeder::class,
            TaskNoteSeeder::class,
            TaskCommentSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
