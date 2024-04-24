@extends('layouts.baseLayout')

@section('title', 'Karakterek')
@section('header', 'Karakterek')

@section('content')
        <table class="table table-pin-rows">
            <thead class="text-center">
                <tr>
                    <th>Név</th>
                    <th>Védekező képességpont</th>
                    <th>Támadó képességpont</th>
                    <th>Pontosság képességpont</th>
                    <th>Mágikus képességpont</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($characters as $character)
                    <tr>
                        <td><a href="{{ route('characters.show', ['character' => $character->id]) }}"">{{$character->name}}</a></td>
                        <td>{{$character->defence}}</td>
                        <td>{{$character->strength}}</td>
                        <td>{{$character->accuracy}}</td>
                        <td>{{$character->magic}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
