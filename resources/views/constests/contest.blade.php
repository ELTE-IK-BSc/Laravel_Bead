@extends('layouts.baseLayout')

@section('title', 'Mérkőzés')
@section('header', 'Mérkőzés')

@section('content')
    @isset($contest->win)
        <h1 class="w-full text-center text-xl">
            @if ($contest->win)
                WON
            @else
                DEFETED
            @endif
        </h1>
    @endisset
    <div class="flex justify-evenly">
        <table class="table table-pin-rows max-w-fit">
            <thead class="text-center">
                <tr>
                    <th colspan="2"> {{ $character->name }}</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <th>Életerő</th>
                    <td>
                        {{ $character->pivot->hero_hp }}
                        <i class="fa-solid fa-heart"></i>
                    </td>
                </tr>
                <tr>
                    <th>Védekezés</th>
                    <td>
                        {{ $character->defence }}
                        <i class="fa-solid fa-shield-halved"></i>
                    </td>
                </tr>
                <tr>
                    <th>Támadás</th>
                    <td>
                        {{ $character->strength }}
                        <i class="fa-solid fa-hand-fist"></i>
                    </td>
                </tr>
                <tr>
                    <th>Pontosság</th>
                    <td>
                        {{ $character->accuracy }}
                        <i class="fa-solid fa-crosshairs"></i>
                    </td>
                </tr>
                <tr>
                    <th>Mágikusság</th>
                    <td>
                        {{ $character->magic }}
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <h1>History</h1>
            <p>{{ $contest->history }}</p>
        </div>
        <table class="table table-pin-rows max-w-fit">
            <thead class="text-center">
                <tr>
                    <th colspan="2"> {{ $enemy->name }}</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <th>Életerő</th>
                    <td>
                        {{ $enemy->pivot->enemy_hp }}

                        <i class="fa-solid fa-heart"></i>
                    </td>
                </tr>
                <tr>
                    <th>Védekezés</th>
                    <td>
                        {{ $enemy->defence }}
                        <i class="fa-solid fa-shield-halved"></i>
                    </td>
                </tr>
                <tr>
                    <th>Támadás</th>
                    <td>
                        {{ $enemy->strength }}
                        <i class="fa-solid fa-hand-fist"></i>
                    </td>
                </tr>
                <tr>
                    <th>Pontosság</th>
                    <td>
                        {{ $enemy->accuracy }}
                        <i class="fa-solid fa-crosshairs"></i>
                    </td>
                </tr>
                <tr>
                    <th>Mágikusság</th>
                    <td>
                        {{ $enemy->magic }}
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @isset($contest->win)
    @else
        <div class="flex flex-row items-center gap-1">
            <h2>Csapások: </h2>
            <ul class="flex justify-start">
                <li>
                    <a class="btn btn-primary p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 "
                        href="{{ route('contest.attack', ['id' => $contest->id, 'attacktype' => 'melee']) }}">Melee</a>
                </li>
                <li>
                    <a class="btn btn-primary p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 btn btn- "
                        href="{{ route('contest.attack', ['id' => $contest->id, 'attacktype' => 'ranged']) }}">Ranged</a>
                </li>
                <li>
                    <a class="btn btn-primary p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 btn btn- "
                        href="{{ route('contest.attack', ['id' => $contest->id, 'attacktype' => 'special']) }}">Special</a>
                </li>
            </ul>
        </div>
    @endisset

@endsection
