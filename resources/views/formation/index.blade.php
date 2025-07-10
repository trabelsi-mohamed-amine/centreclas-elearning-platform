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

    <!-- Main content -->
    <div class="container mt-4" style="margin-left: 320px; width: calc(100% - 320px);">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"> Liste des Formations</h1>
            <a href="{{ route('formation.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header bg-white py-3">
                <form method="GET" action="{{ route('formation.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher formation..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>Prix(DT)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formation as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('formation.sessions', $item->id) }}" class="text-decoration-none">
                                            {{ $item->name }}
                                        </a>
                                    </td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->duration }} heures</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('formation.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                                 Modifier
                                            </a>
                                            <form action="{{ route('formation.destroy', $item->id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this formation?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Supprimer
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

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
