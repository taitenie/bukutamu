@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="p-8 rounded-lg shadow-md relative min-h-[570px] bg-white bg-opacity-70 flex flex-col justify-start pt-8"
         style="background-image: url('/images/bg1.png'); background-position: center; background-size: cover;">
        <div class="mt-8">
            <h2 class="text-gray-600">Hi, {{ Auth::user()->name }}</h2>
            <h1 class="text-3xl font-bold">Welcome back <span class="wave">👋</span></h1>
            <p class="text-gray-600 mt-2">
                Empower your day with insights and actions. <br>
                Let's make an impact together!
            </p>
        </div>
    </div>
@endsection
