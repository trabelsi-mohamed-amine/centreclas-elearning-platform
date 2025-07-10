@extends('layouts.app')

@section('content')
<x-guest-layout>
    <div class="d-flex min-vh-100">
        <!-- Colonne pour l'image à gauche -->
        <div class="col-md-6 text-center text-md-start" style="padding-left: 100px;">
            <img src="{{ asset('image/pppc.png') }}" alt="Illustration"
                 class="img-fluid" style="max-width: 90%; height: auto;">
        </div>

        <!-- Colonne pour le formulaire à droite -->
        <div class="d-flex justify-content-center align-items-center" style="width: 60%; padding: 50px;">
            <div class="card p-5 shadow-lg" style="width: 100%; max-width: 600px; background: linear-gradient(to right, #9b4d96, #6a1b9a); border-radius: 20px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h3 class="text-center mb-5 text-white">{{ __('Inscrire') }}</h3>

                    <form method="POST" action="{{ route('register') }}" class="w-100 needs-validation" novalidate>
                        @csrf

                        <!-- Name -->
                        <div class="form-group mb-4">
                            <label for="name" class="text-white">{{ __('Nom') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input id="name" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="text" name="name" value="{{ old('name') }}"
                                       required autofocus autocomplete="name" />
                            </div>
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group mb-4">
                            <label for="email" class="text-white">{{ __('Email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="email" name="email" value="{{ old('email') }}"
                                       required autocomplete="username" />
                            </div>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- CIN -->
                        <div class="form-group mb-4">
                            <label for="cin" class="text-white">{{ __('CIN') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-id-card"></i>
                                </span>
                                <input id="cin" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="text" name="cin" value="{{ old('cin') }}"
                                       required minlength="8" maxlength="8" data-numeric-only="true" />
                            </div>
                            <small class="form-text text-white-50">8 chiffres requis</small>
                            @error('cin')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group mb-4">
                            <label for="telephone" class="text-white">{{ __('Telephone') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input id="telephone" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="text" name="telephone" value="{{ old('telephone') }}"
                                       required minlength="8" maxlength="8" data-numeric-only="true" />
                            </div>
                            <small class="form-text text-white-50">8 chiffres requis</small>
                            @error('telephone')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="form-group mb-4">
                            <label for="date_of_birth" class="text-white">{{ __('Date de naissance') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                <input id="date_of_birth" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                       required max="{{ date('Y-m-d') }}" />
                            </div>
                            @error('date_of_birth')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-4">
                            <label for="password" class="text-white">{{ __('Mot de passe') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="password" name="password" required autocomplete="new-password" minlength="8" />
                            </div>
                            <small class="form-text text-white-50">Minimum 8 caractères</small>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="text-white">{{ __('Confirmer mot de passe') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-white border-white">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password_confirmation" class="form-control bg-transparent text-white border-white"
                                       style="border: 1px solid white; padding: 15px;"
                                       type="password" name="password_confirmation" required autocomplete="new-password"
                                       data-match="password" />
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a class="text-decoration-underline text-white" href="{{ route('login') }}">
                                {{ __('Déjà inscrit?') }}
                            </a>

                            <button type="submit" class="btn btn-outline-light"
                                    style="background-color: transparent; border: 1px solid white; color: white; transition: 0.3s; padding: 10px 20px;">
                                <i class="fas fa-user-plus me-2"></i>{{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
@endsection
