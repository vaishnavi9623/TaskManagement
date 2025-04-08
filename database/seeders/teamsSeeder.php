<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use Carbon\Carbon;
class teamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            [
                'name' => 'Development Squad',
                'description' => 'Working on the new e-commerce platform',
                'members' => json_encode([1, 2, 3]), // Store as JSON array
                'lead' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status'=>'Active',
            ],
            [
                'name' => 'Marketing Team',
                'description' => 'Handling all marketing campaigns',
                'members' => json_encode([4, 5, 6]),
                'lead' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status'=>'Active',
            ]
      ]);
    }
}
