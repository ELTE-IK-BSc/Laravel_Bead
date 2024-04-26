@extends('layouts.baseLayout')

@section('title', 'Karakterek részletek')
@section('header', $character->name . ' adatai')
@section('submenuitems')

@endsection
@section('content')
    <div class="flex justify-between gap-5">
        <table class="table table-pin-rows max-w-fit">
            <thead class="text-center">
                <tr>
                    <th colspan="2"> {{ $character->name }}</th>
                </tr>
            </thead>
            <tbody class="text-center">

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
                            <td colspan="3">Nem volt még ütközete!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <ul class="flex flex-col gap-2 even:relative odd:relative">
            <li>
                <a href="{{ route('contests.create') }}"
                    class="hover:after:content-['Új_mérkőzés'] after:absolute  after:right-16 hover:after:p-1 after:z-10 after:bg-slate-600 after:text-gray-50 after:w-fit btn hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-300 dark:hover:text-gray-600 ">
                    <i class="fa-solid fa-compass  fa-fw fa-xl"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('characters.edit', ['character' => $character->id]) }}"
                    class="hover:after:content-['Szerkeztés'] after:absolute  after:right-16 hover:after:p-1 after:z-10 after:bg-slate-600 after:text-gray-50 after:w-fit btn hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-300 dark:hover:text-gray-600 ">
                    <i class="fa-solid fa-pen-to-square fa-fw fa-xl"></i>
                </a>
            </li>
            <li>
                <form action="{{ route('characters.destroy', ['character' => $character->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button
                        class="hover:after:content-['Törlés'] after:absolute  after:right-16 hover:after:p-1 after:z-10 after:bg-slate-600 after:text-gray-50 after:w-fit btn hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-300 dark:hover:text-gray-600 ">
                        <i class="fa-solid fa-trash-can fa-fw fa-xl"></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>

@endsection
