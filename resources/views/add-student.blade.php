@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Ajouter Apprenant</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un nom.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une adresse email valide.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Mot de passe:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" required minlength="8">
                            <div class="invalid-feedback">
                                Le mot de passe doit contenir au moins 8 caractères.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmer mot de passe:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required data-match="password">
                            <div class="invalid-feedback">
                                Les mots de passe ne correspondent pas.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cin" class="form-label">CIN:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" id="cin" name="cin" class="form-control" value="{{ old('cin') }}"
                                required minlength="8" maxlength="8" data-numeric-only="true">
                            <div class="invalid-feedback">
                                Le CIN doit contenir exactement 8 chiffres.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Telephone:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') }}"
                                required minlength="8" maxlength="8" data-numeric-only="true">
                            <div class="invalid-feedback">
                                Le numéro de téléphone doit contenir exactement 8 chiffres.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="date_of_birth" class="form-label">Date de naissance:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                            value="{{ old('date_of_birth') }}" required max="{{ date('Y-m-d') }}">
                        <div class="invalid-feedback">
                            Veuillez sélectionner une date de naissance valide.
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
