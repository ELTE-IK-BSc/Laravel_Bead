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
        $characters = Character::all();

        foreach ($characters as $tmpCharacter) {
            if (!$tmpCharacter->enemy) {
                foreach ($places->random(2) as $tmpPlace) {
                    $tmpEnemy = Character::all()->where('enemy', '=', 1)->random(2)->first();

                    Contest::factory()
                        ->hasAttached($tmpCharacter, ['hero' => true])
                        ->hasAttached($tmpEnemy, ['hero' => false])
                        ->create(['user_id' => $tmpCharacter->user_id, 'place_id' => $tmpPlace->id]);
                }
            }
        }
    }
}
