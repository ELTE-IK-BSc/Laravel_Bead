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

        $newContest = Contest::create(['win' => null, 'history' => '']);
        $newContest->user->attach(Auth::user(), ['user_id' => Auth::user()->id]);
        $newContest->characters->attach($character, ['hero' => true]);
        $newContest->characters->attach($enemy, ['hero' => false]);

        return redirect()->route('contests.show', ['contest' => $newContest->id]);
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
        $character = $contest->hero->first();
        $enemy = $contest->enemy->first();
        return view('constests.contest', ['contest' => $contest, 'character' => $character, 'enemy' => $enemy]);
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
    }
}
