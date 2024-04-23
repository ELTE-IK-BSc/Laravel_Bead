<?php
use App\Models\Character;
use App\Models\Contest;
?>



@extends('layouts.baseLayout')

@section('title', 'Főoldal')
@section('header', 'Főoldal')

@section('content')
        <h2>A játék leírása</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem adipisci fuga sapiente ad, facilis minus maxime
            odio doloribus perspiciatis harum quae ab beatae impedit neque provident facere error. Quia, porro?</p>
        <table class=" m-auto ">
            <thead class="text-center">
                <tr class="bg-blue-300 dark:bg-blue-900">
                    <th class="p-1 ">Karakterek száma</th>
                    <th class="p-1">Lejátszott mérkőzések</th>
                </tr>
            </thead>
            <tbody class="text-center">

                <tr class="bg-blue-100 dark:bg-blue-400">

                    <td>{{ count(Character::all()) }}</td>
                    <td>{{ count(Contest::all()) }}</td>
                </tr>
            </tbody>
        </table>
@endsection
