<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\User;
class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all users and teams
        $users = User::pluck('id')->toArray();
        $teams = Team::pluck('id')->toArray();

        // Check if users and teams exist
        if (empty($users) || empty($teams)) {
            $this->command->info('No users or teams found. Please seed users and teams first.');
            return;
        }

        // Attach random users to random teams
        foreach ($teams as $team) {
            $randomUsers = array_rand($users, min(3, count($users))); // Assign up to 3 users per team
            foreach ((array) $randomUsers as $userIndex) {
                DB::table('team_user')->insert([
                    'team_id' => $team,
                    'user_id' => $users[$userIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Team-user relationships seeded successfully!');
    }
}
