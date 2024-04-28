<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::all();
        return view('places.placeList', ['places' => $places]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('places.placeForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'file' => 'required|file|image',
        ]);


        $imagename = $request->file('file')->store('/public/');

        $place = Place::create([
            'name' => $validated['name'],
            'imagename' => $request->file('file')->getClientOriginalName(),
            'imagename_hash' => $imagename,
        ]);

        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $place = Place::all()->where('id', $id)->first();
        if (!$place) {
            abort(404);
        }

        return view('places.placeForm', ['place' => $place]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'file' => 'nullable|file|image',
        ]);

        $place = Place::all()->where('id', $id)->first();
        if (!$place) {
            abort(404);
        }

        if ($request->hasFile('file')) {
            $imagename = $request->file('file')->store();
            $place->update([
                'name' => $validated['name'],
                'imagename' => $request->file('file')->getClientOriginalName(),
                'imagename_hash' => $imagename,
            ]);
        } else {
            $place->update([
                'name' => $validated['name'],
                'imagename' => $place->imagename,
                'imagename_hash' => $place->imagename_hash,
            ]);
        }

        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $place = Place::all()->where('id', $id)->first();
        if (!$place) {
            abort(404);
        }
        $path = "/storage/app/" . $place->imagename_hash;
        Storage::delete($path);
        $place->delete();

        return redirect()->route('places.index');
    }
}
