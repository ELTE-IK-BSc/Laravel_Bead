<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;
use Laravel\Prompts\Table;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $characterid = $request['charid'];
        $character = Auth::user()->characters()->where('characters.id', $characterid)->first();
        $place = Place::all()->random(1)->first();
        $enemy = Character::all()->where('enemy', '=', 1)->random(1)->first();
        $contest = Contest::factory()->create(['win' => null, 'history' => '', 'user_id' => Auth::user()->id, 'place_id' => $place->id]);
        $contest->characters()->attach($character, ['hero' => true]);
        $contest->characters()->attach($enemy, ['hero' => false]);

        return redirect()->route('contests.show', ['contest' => $contest->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contest = Auth::user()->contests()->where('contests.id', $id)->first();
        if (!$contest) {
            abort(404);
        }

        return view('constests.contest', ['contest' => $contest]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function attack(string $id, string $attackType)
    {
        // check for contest
        $contest = Auth::user()->contests()->where('contests.id', $id)->first();
        if (!$contest) {
            abort(404);
        }
        $charName = $contest->hero->first()->name;
        $enemyName = $contest->enemy->first()->name;

        // create character arrays for round
        $character = [
            'hp' => $contest->hero->first()->pivot->hero_hp,
            'defence' => $contest->hero->first()->defence,
            'strength' => $contest->hero->first()->strength,
            'accuracy' => $contest->hero->first()->accuracy,
            'magic' => $contest->hero->first()->magic,
        ];
        $enemy = [
            'hp' => $contest->enemy->first()->pivot->enemy_hp,
            'defence' => $contest->enemy->first()->defence,
            'strength' => $contest->enemy->first()->strength,
            'accuracy' => $contest->enemy->first()->accuracy,
            'magic' => $contest->enemy->first()->magic,
        ];


        // hero attack
        $attack = $this->calcAttack($attackType, $character, $enemy);

        // update enemy
        $enemyNewHP = $contest->enemy->first()->pivot->enemy_hp - $attack;
        if ($enemyNewHP < 0) {
            $enemyNewHP = 0;
        }
        $contest->enemy->first()->pivot->update(['enemy_hp' => $enemyNewHP]);
        // update history
        $change = $contest->history . "{$charName}: {$attackType} attack - {$attack} demage";
        $contest->update(['history' => $change]);
        // check for end
        if ($contest->enemy->first()->pivot->enemy_hp == 0) {
            $contest->update(['win' => true]);
            return view('constests.contest', ['contest' => $contest]);
        }

        // random selection
        $attacktypes = array("melee", "ranged", "special");
        $attackType = $attacktypes[array_rand($attacktypes)];

        // enemy attack
        $attack = $this->calcAttack($attackType, $character, $enemy);

        // update hero
        $heroNewHP = $contest->hero->first()->pivot->hero_hp - $attack;
        if ($heroNewHP < 0) {
            $heroNewHP = 0;
        }
        $contest->hero->first()->pivot->update(['hero_hp' => $heroNewHP]);
        // update history
        $change = $contest->history . "{$enemyName}: {$attackType} attack - {$attack} demage";
        $contest->update(['history' => $change]);
        // check for end
        if ($contest->hero->first()->pivot->hero_hp == 0) {
            $contest->update(['win' => false]);
            return view('constests.contest', ['contest' => $contest]);
        }

        // return to contest page

        return view('constests.contest', ['contest' => $contest]);
    }

    private function calcAttack(string $attacktype, array $ATT, array $DEF)
    {
        $attack = 0;
        if ($attacktype == "melee") {
            $attack = ($DEF['hp']) - (($ATT['strength'] * 0.7 + $ATT['accuracy'] * 0.1 + $ATT['magic'] * 0.1) - $DEF['defence']);
        } elseif ($attacktype == "ranged") {
            $attack = ($DEF['hp']) - (($ATT['strength'] * 0.1 + $ATT['accuracy'] * 0.7 + $ATT['magic'] * 0.1) - $DEF['defence']);
        } elseif ($attacktype == "special") {
            $attack = ($DEF['hp']) - (($ATT['strength'] * 0.1 + $ATT['accuracy'] * 0.1 + $ATT['magic'] * 0.7) - $DEF['defence']);
        }

        if ($attack > 0) {
            return $attack;
        } else {
            return 0;
        }
    }
}
