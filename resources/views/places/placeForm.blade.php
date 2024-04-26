@extends('layouts.baseLayout')

@isset($place)
    @section('title', $place->name . ' módosítás')
@section('header', $place->name . ' módosítás')
@else
@section('title', 'Új helyszín')
@section('header', 'Új helyszín')
@endisset



@section('content')
<div class="divider"></div>
<div class="flex justify-center">
    <form method="POST"
        action="@isset($place) {{ route('places.update', ['place' => $place->id]) }} @else {{ route('places.store') }} @endisset"
        enctype="multipart/form-data">
        @csrf
        @isset($place)
            @method('PUT')
        @endisset
        <div class="flex gap-5 flex-col justify-end">
            <div class="w-full">
                <input type="text" placeholder="Név"
                    class="input input-bordered text-gray-800 w-full  @error('title') input-error @enderror"
                    name="name" id="name" value="{{ old('name', $place->name ?? '') }}" />
                @error('name')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="pb-5">
                <input type="file"
                    class="file-input file-input-bordered w-full @error('file') file-input-error @enderror"
                    name="file" id="file" />
                @error('file')
                    <div class="label">
                        <span class="label-text-alt text-red-600">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-5 w-full">Mentés</button>
        </div>
    </form>
</div>
@endsection
