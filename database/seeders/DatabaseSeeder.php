<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Judge;
use App\Models\Score;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        $users = User::factory(10)->create();

        // Create test judges
        $judges = [
            ['username' => 'judge1', 'display_name' => 'Judge One'],
            ['username' => 'judge2', 'display_name' => 'Judge Two'],
            ['username' => 'judge3', 'display_name' => 'Judge Three'],
        ];

        foreach ($judges as $judge) {
            Judge::create($judge);
        }

        // Create some random scores
        $judges = Judge::all();
        foreach ($users as $user) {
            foreach ($judges as $judge) {
                if (rand(0, 1)) { // 50% chance of having a score
                    Score::create([
                        'judge_id' => $judge->id,
                        'user_id' => $user->id,
                        'points' => rand(1, 100)
                    ]);
                }
            }
        }
    }
}
