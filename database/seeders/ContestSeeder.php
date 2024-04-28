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

                    $contest = Contest::factory()
                        ->create(['user_id' => $tmpCharacter->user_id, 'place_id' => $tmpPlace->id]);
                    $lifeleft = fake()->numberBetween(1, 20);
                    if ($contest->win) {
                        $contest->characters()
                            ->attach($tmpCharacter, ['hero' => true, 'hero_hp' => $lifeleft, 'enemy_hp' => 0]);
                        $contest->characters()
                            ->attach($tmpEnemy, ['hero' => false, 'hero_hp' => $lifeleft, 'enemy_hp' => 0]);
                    } else {
                        $contest->characters()
                            ->attach($tmpCharacter, ['hero' => true, 'hero_hp' => 0, 'enemy_hp' => $lifeleft]);
                        $contest->characters()
                            ->attach($tmpEnemy, ['hero' => false, 'hero_hp' => 0, 'enemy_hp' => $lifeleft]);
                    }
                }
            }
        }
    }
}
