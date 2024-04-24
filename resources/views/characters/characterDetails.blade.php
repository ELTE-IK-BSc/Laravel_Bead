@extends('layouts.baseLayout')

@section('title', 'Karakterek részletek')
@section('header', $character->name . ' adatai')

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
                    <td>{{ $character->name }}</td>
                </tr>
                <tr>
                    <th>Védekező képességpont</th>
                    <td>{{ $character->defence }}</td>
                </tr>
                <tr>
                    <th>Pontosság képességpont</th>
                    <td>{{ $character->accuracy }}</td>
                </tr>
                <tr>
                    <th>Támadó képességpont</th>
                    <td>{{ $character->strength }}</td>
                </tr>
                <tr>
                    <th>Mágikus képességpont</th>
                    <td>{{ $character->magic }}</td>
                </tr>
            </tbody>
        </table>
        <div class="flex-grow">

            <table class="table table-pin-rows ">
                <thead class="text-center">
                    <tr>
                        <th>Helyszín</th>
                        <th>Ellenfél</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    {{ $hasAny = false }}
                    @foreach ($character->contests()->where('hero', '=', 1)->get() as $contest)
                        {{ $hasAny = true }}
                        <tr>
                            <td>{{ $contest->place->name }}</td>
                            <td>{{ $contest->enemy->first()->name }}</td>
                        </tr>
                    @endforeach
                    @foreach ($character->contests()->where('hero', '=', 0)->get() as $contest)
                        {{ $hasAny = true }}
                        <tr>
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
