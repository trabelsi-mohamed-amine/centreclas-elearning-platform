@extends('layouts.app')

@section('content')
<div class="account-settings">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="settings-card">
                    <div class="settings-header">
                        <h3 class="mb-0"><i class="fas fa-user-cog me-2"></i>Modifier Profil</h3>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <ul class="list-unstyled mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('account.settings.update') }}" class="p-4 needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre nom.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    <div class="invalid-feedback">
                                        Veuillez entrer une adresse email valide.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin', $user->cin) }}"
                                        required minlength="8" maxlength="8" data-numeric-only="true">
                                    <div class="invalid-feedback">
                                        Le CIN doit contenir exactement 8 chiffres.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Telephone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}"
                                        required minlength="8" maxlength="8" data-numeric-only="true">
                                    <div class="invalid-feedback">
                                        Le numéro de téléphone doit contenir exactement 8 chiffres.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date de naissance</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth', $user->date_of_birth) }}" required max="{{ date('Y-m-d') }}">
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une date de naissance valide.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Laisser vide pour conserver le mot de passe actuel" minlength="8">
                                    <div class="invalid-feedback">
                                        Le mot de passe doit contenir au moins 8 caractères.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirmer nouveau mot de passe"
                                        data-match="password">
                                    <div class="invalid-feedback">
                                        Les mots de passe ne correspondent pas.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-update w-100">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.account-settings {
    background: linear-gradient(to right bottom, #f8f9fa, #ffffff);
    min-height: 100vh;
    padding: 40px 0;
}

.settings-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.settings-header {
    background: linear-gradient(to right, #9b4eb0, #eb69d7);
    padding: 20px;
    color: white;
    text-align: center;
}

.form-label {
    font-weight: 600;
    color: #444;
}

.form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 3px rgba(155, 78, 176, 0.2);
    border-color: #9b4eb0;
}

.btn-update {
    background: linear-gradient(to right, #9b4eb0, #eb69d7);
    border: none;
    padding: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(155, 78, 176, 0.3);
}

.input-group-text {
    background: transparent;
    border: none;
    color: #9b4eb0;
}
</style>
@endsection


