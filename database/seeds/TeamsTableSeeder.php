<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $randomNumber = rand(123, 789);

            $team = Team::factory()->create([
                'name' => "Hospital $randomNumber",
            ]);

            $director = User::factory()->create([
                'name'           => "adones evangelista",
                'email'          => "adones{$randomNumber}@gmail.com",
                'password'       => bcrypt('$2y$10$hc4VRoj6boBg7XBFPM0wiuJMJRoM9z/.i6iUq8ZH3.0zPhbQ030MK'),
                'team_id'        => $team->id,
                'remember_token' => null,
            ]);
            $director->roles()->sync(2);

            $doctor = User::factory()->create([
                'name'           => "jude suares",
                'email'          => "jude{$randomNumber}@gmail.com",
                'password'       => bcrypt('$2y$10$mo2628I/B0hAEgxXcT1F/OiCprXKgEdNQk4rKvPQy7Xqu39e3XmsG'),
                'team_id'        => $team->id,
                'remember_token' => null,
            ]);
            $doctor->roles()->sync(2);
        }
    }
}
