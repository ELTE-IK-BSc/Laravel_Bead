@extends('layouts.baseLayout')

@isset($character)
    @section('title', $character->name . ' módosítás')
@section('header', $character->name . ' módosítás')
@else
@section('title', 'Új karakter')
@section('header', 'Új karakter')
@endisset



@section('content')
<div class="divider"></div>
<div class="flex justify-center">
    <form method="POST"
        action="@isset($character) {{ route('characters.update', ['character' => $character->id]) }} @else {{ route('characters.store') }} @endisset"
        enctype="multipart/form-data">
        @csrf
        @isset($character)
            @method('PUT')
        @endisset
        <div class="flex gap-5 flex-col justify-end">
            <div class="w-full">
                <input type="text" placeholder="Név"
                    class="input input-bordered text-gray-800 w-full  @error('title') input-error @enderror"
                    name="name" id="name" value="{{ old('name', $character->name ?? '') }}" />
                @error('name')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="w-full">
                <input type="text" placeholder="Védekezés"
                    class="input input-bordered text-gray-800 w-full @error('title') input-error @enderror"
                    name="defence " id="defence " value="{{ old('defence ', $character->defence ?? '') }}" />
                @error('defence ')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="w-full">
                <input type="text" placeholder="Támadás"
                    class="input input-bordered text-gray-800 w-full @error('title') input-error @enderror"
                    name="strength" id="strength" value="{{ old('strength', $character->strength ?? '') }}" />
                @error('strength')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="w-full">
                <input type="text" placeholder="Pontosság"
                    class="input input-bordered text-gray-800 w-full @error('title') input-error @enderror"
                    name="accuracy " id="accuracy" value="{{ old('accuracy', $character->accuracy ?? '') }}" />
                @error('accuracy')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="w-full">
                <input type="text" placeholder="Mágikusság"
                    class="input input-bordered text-gray-800 w-full @error('title') input-error @enderror"
                    name="magic" id="magic" value="{{ old('magic', $character->magic ?? '') }}" />
                @error('magic')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            @if (Auth::user()->admin)
                <div class="place-self-end">
                    <label for="enemy">Ellenség</label>
                    <input type="checkbox" class="input input-bordered @error('title') input-error @enderror"
                        name="enemy" id="enemy" value="{{ old('enemy', $character->enemy ?? '') }}" />
                    @error('enemy')
                        <div class="label">
                            <span class="label-text-alt text-red-600">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            @endif
            <button type="submit" class="btn btn-primary mt-5 w-full">Mentés</button>
        </div>
    </form>
</div>
@endsection
