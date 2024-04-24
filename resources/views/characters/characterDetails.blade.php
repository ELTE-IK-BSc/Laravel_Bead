@extends('layouts.baseLayout')

@section('title', 'Karakterek részletek')
@section('header', $character->name . ' adatai')
@section('submenuitems')
    <li class="inline-block"> <a href="{{ route('contests.create') }}"
            class="p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 ">Új
            mérkőzés</a></li>

@endsection
@section('content')
    <div class="flex justify-between gap-5">
        <table class="table table-pin-rows max-w-fit">
            <thead class="text-center">
                <tr>
                    <th colspan="2">Karakter Adatok</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <th>Név</th>
                    <td>
                        {{ $character->name }}
                    </td>
                </tr>
                <tr>
                    <th>Védekező képességpont</th>
                    <td>
                        {{ $character->defence }}
                        <i class="fa-solid fa-shield-halved"></i>
                    </td>
                </tr>
                <tr>
                    <th>Pontosság képességpont</th>
                    <td>
                        {{ $character->accuracy }}
                        <i class="fa-solid fa-crosshairs"></i>
                    </td>
                </tr>
                <tr>
                    <th>Támadó képességpont</th>
                    <td>
                        {{ $character->strength }}
                        <i class="fa-solid fa-hand-fist"></i>
                    </td>
                </tr>
                <tr>
                    <th>Mágikus képességpont</th>
                    <td>
                        {{ $character->magic }}
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex-grow">

            <table class="table table-pin-rows ">
                <thead class="text-center table-header-group">
                    <tr>
                        <th>Mérkőzés</th>
                        <th>Helyszín</th>
                        <th>Ellenfél</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $hasAny = false;
                    @endphp
                    @foreach ($character->contests()->where('hero', '=', 1)->get() as $contest)
                        @php
                            $hasAny = true;
                        @endphp
                        <tr>
                            <td><a href="{{ route('contests.show', ['contest' => $contest->id]) }}">
                                    <i class="fa-solid fa-gamepad fa-fw fa-xl"></i>
                                </a></td>
                            <td>{{ $contest->place->name }}</td>
                            <td>{{ $contest->enemy->first()->name }}</td>
                        </tr>
                    @endforeach
                    @foreach ($character->contests()->where('hero', '=', 0)->get() as $contest)
                        @php
                            $hasAny = true;
                        @endphp
                        <tr>
                            <td><a href="{{ route('contests.show', ['contest' => $contest->id]) }}">
                                    <i class="fa-solid fa-gamepad fa-fw fa-xl"></i>
                                </a></td>
                            <td>{{ $contest->place->name }}</td>
                            <td>{{ $contest->hero->first()->name }}</td>
                        </tr>
                    @endforeach
                    @if (!$hasAny)
                        <tr>
                            <td colspan="2">Nem volt még ütközete!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
