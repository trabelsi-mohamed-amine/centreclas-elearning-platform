@php($hideNavbar = true)
@php($hideFooter = true)
@extends('layouts.app')

@section('content')
<div class="d-flex"> <!-- Flex pour sidebar + contenu -->

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

    <!-- Contenu principal (Sessions) -->
    <div class="container mt-5" style="margin-left: 320px;"> <!-- Décalage à droite pour éviter d'être caché par sidebar -->
        @if(auth()->user()->role_id === 1) <!-- Check if the user is an admin -->
            <h1 class="mb-4">Les Sessions</h1>

            <!-- Back to Dashboard Button -->

            <!-- Add Session Button -->
            <button class="btn btn-success mb-3" onclick="window.location.href='{{ route('sessions.create') }}'">Ajouter</button>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>Formateur</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->description }}</td>
                            <td>{{ $session->start_time }}</td>
                            <td>{{ $session->end_time }}</td>
                            <td>{{ $session->teacher ? $session->teacher->name : 'Not Assigned' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('sessions.edit', $session->id) }}'">Modifier</button>

                                <!-- Delete Form -->
                                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this session?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-danger">You do not have permission to view this page.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    table th, table td {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endsection
