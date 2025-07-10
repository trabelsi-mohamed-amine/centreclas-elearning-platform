@extends('layouts.app')

@section('content')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="d-flex min-vh-100">
        <!-- Colonne pour l'image à gauche -->
        <div class="col-md-6 text-center text-md-start" style="padding-left: 150px;">
            <img src="{{ asset('image/pppc.png') }}" alt="Illustration"
                 class="img-fluid" style="max-width: 110%; height: auto;">
        </div>

        <!-- Colonne pour le formulaire à droite -->
        <div class="d-flex justify-content-center align-items-center" style="width: 50%; padding-left: 20px; padding-right: 40px;">
            <div class="card p-4 shadow-sm" style="width: 100%; max-width: 450px; height: 600px; background: linear-gradient(to right, #9b4d96, #6a1b9a); border-radius: 15px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h3 class="text-center mb-4 text-white">{{ __('Connectez-vous à votre compte') }}</h3>

                    <form method="POST" action="{{ route('login') }}" class="w-100">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group mb-3">
                            <label for="email" class="text-white">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email"
                                   :value="old('email')" required autofocus autocomplete="username"
                                   style="background-color: transparent; color: white; border: 1px solid white;" />
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="text-white">{{ __('Mot de passe') }}</label>
                            <input id="password" class="form-control" type="password" name="password"
                                   required autocomplete="current-password"
                                   style="background-color: transparent; color: white; border: 1px solid white;" />
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                   

                        <div class="d-flex justify-content-between align-items-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-underline text-white" href="{{ route('password.request') }}">
                                    {{ __('') }}
                                </a>
                            @endif

                            <button type="submit" class="btn btn-outline-light" style="background-color: transparent; border: 1px solid white; color: white; transition: 0.3s;">
                                {{ __('Se connecter') }}
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
@endsection
