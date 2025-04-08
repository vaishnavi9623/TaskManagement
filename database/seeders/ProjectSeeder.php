<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Project::create([
                'name' => $faker->company,
                'description' => $faker->text(200),
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'status' => $faker->randomElement(['pending', 'ongoing', 'completed', 'on_hold']),
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
                'client_name' => $faker->company,
                'client_contact' => $faker->phoneNumber,
                'project_manager' => $faker->numberBetween(1, 4), // valid ID between 1-4
                'assigned_team' => $faker->numberBetween(1, 4),   // valid ID between 1-4
                'budget' => $faker->numberBetween(10000, 100000),
                'notes' => $faker->paragraph,
               
                'attachments' => json_encode(['file1.pdf', 'file2.jpg']),
                'project_code' => $faker->uuid,
            ]);
        }
    }
}
