@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')

@stop

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="h4 font-weight-bold">
                {{ __('Perfil') }}
            </h2>
        </x-slot>

        <div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')

                <x-jet-section-border />
            @endif

            @livewire('profile.logout-other-browser-sessions-form')
        </div>
    </x-app-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop




