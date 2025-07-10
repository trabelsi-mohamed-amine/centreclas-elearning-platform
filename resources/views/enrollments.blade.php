@php($hideNavbar = true)
@extends('layouts.app')

@section('content')
<div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <!-- Sidebar -->
<div class="bg-white shadow-sm p-3" style="width: 300px; height: 100vh; position: fixed;">
    <h4 class="fw-bold text-primary mb-4">CentreCLAS</h4>
    <ul class="nav flex-column">
        <!-- Lien Home -->
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
            <a class="nav-link text-dark" href="/teachers">
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
    <div class="flex-grow-1" style="margin-left: 300px;">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Les demandes de participations</h1>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Numero</th>
                        <th>Nom</th>
                        <th>Nom Formation</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ \App\Models\User::find($enrollment->user_id)?->name }}</td>
                            <td>{{ \App\Models\Formation::find($enrollment->formation_id)?->name }}</td>
                            <td>{{ $enrollment->status }}</td>
                            <td>
                                @if($enrollment->status !== 'accepted')
                                <div class="d-flex flex-column gap-2">
                                    <!-- Accept form with session dropdown -->
                                    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="status" value="accepted">
                                            <select name="session_id" class="form-select form-select-sm" required>
                                                <option value="">Choisir une session...</option>
                                                @if(isset($formationSessions[$enrollment->formation_id]))
                                                    @foreach($formationSessions[$enrollment->formation_id] as $session)
                                                        <option value="{{ $session->id }}">
                                                            {{ $session->title }} ({{ \Carbon\Carbon::parse($session->start_time)->format('d/m/Y H:i') }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type="submit" class="btn btn-success btn-sm">Accepter</button>
                                        </div>
                                    </form>

                                    <!-- Delete form -->
                                    <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                          method="POST"
                                          data-confirm="true"
                                          data-confirm-message="Êtes-vous sûr de vouloir supprimer cette demande ? Cette action est irréversible.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-trash-alt me-1"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                                @else
                                <div class="d-flex flex-column gap-2">
                                    <!-- Session change form for already accepted enrollments -->
                                    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="status" value="accepted">
                                            <select name="session_id" class="form-select form-select-sm" required>
                                                @if(isset($formationSessions[$enrollment->formation_id]))
                                                    @foreach($formationSessions[$enrollment->formation_id] as $session)
                                                        <option value="{{ $session->id }}" {{ $enrollment->session_id == $session->id ? 'selected' : '' }}>
                                                            {{ $session->title }} ({{ \Carbon\Carbon::parse($session->start_time)->format('d/m/Y H:i') }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Changer</button>
                                        </div>
                                    </form>

                                    <!-- Delete form -->
                                    <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                          method="POST"
                                          data-confirm="true"
                                          data-confirm-message="Êtes-vous sûr de vouloir supprimer cette demande ? Cette action est irréversible.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-trash-alt me-1"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script pour confirmer la déconnexion -->
<script>
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
@endsection
