<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Character;
use App\Models\User;
use App\Models\Contest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = Place::all();
        $users = User::all();

        foreach ($users as $user) {
            $tmpPlace = $places->random(1)[0];
            $tmpCharacter = $user->characters->random(1)[0];

            Contest::factory(2)->for($tmpPlace)
                ->hasAttached($tmpCharacter)
                ->create(['user_id' => $user->id]);
        }
    }
}
