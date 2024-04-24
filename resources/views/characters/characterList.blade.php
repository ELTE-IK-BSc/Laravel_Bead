@extends('layouts.baseLayout')

@section('title', 'Karakterek')
@section('header', 'Karakterek')
@section('submenuitems')
    <li class="inline-block"> <a href="{{ route('characters.create') }}"
            class="p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 ">Új
            karakter</a></li>

@endsection

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
                    <td><a href="{{ route('characters.show', ['character' => $character->id]) }}"">{{ $character->name }}</a></td>
                    <td>{{ $character->defence }}</td>
                    <td>{{ $character->strength }}</td>
                    <td>{{ $character->accuracy }}</td>
                    <td>{{ $character->magic }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
