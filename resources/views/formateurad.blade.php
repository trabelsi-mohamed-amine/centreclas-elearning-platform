@php($hideNavbar = true)
@php($hideFooter = true)
@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-white shadow-sm p-3" style="width: 300px; height: 100vh; position: fixed;">
        <h4 class="fw-bold text-primary mb-4">CentreCLAS</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-dark {{ Request::is('dashboard') ? 'active-link' : '' }}" href="{{ url('/dashboard') }}">
                    <i class="fas fa-home me-2"></i> Accueil
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark" href="/students">
                    <i class="fas fa-user-graduate me-2"></i> Les Apprenants
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark {{ Request::is('teachers') ? 'active-link' : '' }}" href="/teachers">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Les Formateurs
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark" href="/enrollments">
                    <i class="fas fa-clipboard-list me-2"></i> Les Demandes
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark" href="/formation">
                    <i class="fas fa-graduation-cap me-2"></i> Les Formations
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-dark {{ Request::is('account-settings') ? 'active-link' : '' }}" href="{{ url('/account-settings') }}">
                    <i class="fas fa-cogs me-2"></i> Paramètres du Compte
                </a>
            </li>
            <li class="nav-item mt-4">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="confirmLogout(event);" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="container mt-4" style="margin-left: 300px; width: calc(100% - 300px);">
        <div class="row mb-4">
            <div class="col">
                <h1 class="text-primary">Liste des Formateurs</h1>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <!-- Search and Add Teacher Row -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-8">
                        <form method="GET" action="{{ route('teachers.index') }}" class="d-flex gap-2">
                            <input type="text"
                                name="search"
                                class="form-control"
                                placeholder="Rechercher un Formateur..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="fas fa-search"></i>
                                Rechercher
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="{{ route('teachers.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Ajouter
                        </a>
                    </div>
                </div>

                <!-- Teachers Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>CIN</th>
                                <th>Telephone</th>
                                <th>Date de naissance</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->id }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->cin }}</td>
                                    <td>{{ $teacher->telephone }}</td>
                                    <td>{{ $teacher->date_of_birth }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-1"></i> Modifier
                                            </a>
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  data-confirm="true"
                                                  data-confirm-message="Êtes-vous sûr de vouloir supprimer ce formateur ? Cette action est irréversible et supprimera toutes les données associées.">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt me-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>

@endsection
