<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Character::factory(2)->for($user)->create();
            if ($user->admin) {
                Character::factory(10)->for($user)->create(['enemy' => true,]);
            }
        }


    }
}
