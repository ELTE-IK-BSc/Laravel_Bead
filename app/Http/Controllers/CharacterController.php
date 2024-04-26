<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Character;


class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Auth::user()->characters()->get();
        return view('characters.characterList', ['characters' => $characters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('characters.characterForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'enemy' => 'nullable|boolean',
                'defence' => 'required|integer|min:0|max:3',
                'strength' => 'required|integer|min:0|max:20',
                'accuracy' => 'required|integer|min:0|max:20',
                'magic' => 'required|integer|min:0|max:20',
            ]
        );

        $validator->after(function ($validator) use ($request) {
            $total = $request->defence + $request->strength + $request->accuracy + $request->magic;
            if ($total > 20) {
                $validator->errors()->add('defence', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
                $validator->errors()->add('strength', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
                $validator->errors()->add('accuracy', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
                $validator->errors()->add('magic', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
            }
        });

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }
        $data = $validator->valid();
        $data['user_id'] = Auth::id();
        $character = Character::create($data);
        return redirect()->route('characters.show', ['character' => $character->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $character = Auth::user()->characters()->where('characters.id', $id)->first();
        if (!$character) {
            abort(404);
        }
        return view('characters.characterDetails', ['character' => $character]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $character = Auth::user()->characters()->where('characters.id', $id)->first();
        if (!$character) {
            abort(404);
        }
        return view('characters.characterForm', ['character' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'enemy' => 'nullable|boolean',
                'defence' => 'required|integer|min:0|max:3',
                'strength' => 'required|integer|min:0|max:20',
                'accuracy' => 'required|integer|min:0|max:20',
                'magic' => 'required|integer|min:0|max:20',
            ]
        );

        $validator->after(function ($validator) use ($request) {
            $total = $request->defence + $request->strength + $request->accuracy + $request->magic;
            if ($total > 20) {
                $validator->errors()->add('defence', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
                $validator->errors()->add('strength', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
                $validator->errors()->add('accuracy', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
                $validator->errors()->add('magic', 'The sum of defence, strength, accuracy, and magic attributes must not greater than 20.');
            }
        });

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        $character = Auth::user()->characters()->where('characters.id', $id)->first();
        if (!$character) {
            abort(404);
        }

        $character->update($validator->valid());

        return redirect()->route('characters.show', ['character' => $character->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
