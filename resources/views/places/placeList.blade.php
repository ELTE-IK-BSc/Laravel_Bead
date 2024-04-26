@extends('layouts.baseLayout')

@section('title', 'Helyszínek')
@section('header', 'Helyszínek')
@section('submenuitems')
    <li class="inline-block"> <a href="{{ route('places.create') }}"
            class="p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 ">Új
            helyszín</a></li>

@endsection

@section('content')


    <table class="table table-pin-rows ">
        <thead class="text-center table-header-group">
            <tr>
                <th>Név</th>
                <th>Kép</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-center">

            @foreach ($places as $place)
                <tr>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->imagename }}</td>
                    <td class="w-fit">
                        <a href="{{ route('places.edit', ['place' => $place->id]) }}"
                            class="hover:after:content-['Szerkeztés'] after:absolute  after:right-16 hover:after:p-1 after:z-10 after:bg-slate-600 after:text-gray-50 after:w-fit btn hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-300 dark:hover:text-gray-600 ">
                            <i class="fa-solid fa-pen-to-square fa-fw fa-xl"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('places.destroy', ['place' => $place->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button
                                class="hover:after:content-['Törlés'] after:absolute  after:right-16 hover:after:p-1 after:z-10 after:bg-slate-600 after:text-gray-50 after:w-fit btn hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-300 dark:hover:text-gray-600 ">
                                <i class="fa-solid fa-trash-can fa-fw fa-xl"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
@endsection
