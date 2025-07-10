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
                <i class="fas fa-cogs me-2"></i> Paramètres du Profil
            </a>
        </li>
        <li class="nav-item mt-4">
            <form id="logout-form-home" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="confirmLogout(event, 'logout-form-home');" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                </a>
            </form>
        </li>
    </ul>
</div>


    <!-- Main Content -->
    <main class="flex-grow-1 py-5 bg-light" style="margin-left: 300px;">
        <div class="container">
            <h1 class="mb-4 fw-bold text-primary">Tableau de bord "Administrateur"</h1>

            <!-- statistiques -->
            <div class="statistics row g-4">
                <!-- Cards statistiques -->
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 bg-primary text-white hover-shadow transition" style="height: 150px; width: 230px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white p-2 me-3">
                                    <i class="fas fa-user-graduate text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1">Apprenant</h6>
                                    <h2 class="card-title mb-0">{{ $studentsCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 rounded-4 bg-success text-white hover-shadow transition" style="height: 150px; width: 230px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white p-2 me-3">
                                    <i class="fas fa-chalkboard-teacher text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1">Les Formateurs</h6>
                                    <h2 class="card-title mb-0">{{ $teachersCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 rounded-4 bg-info text-white hover-shadow transition" style="height: 150px; width: 230px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white p-2 me-3">
                                    <i class="fas fa-clock text-info fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1"> Les Sessions</h6>
                                    <h2 class="card-title mb-0">{{ $sessionsCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 rounded-4 bg-warning text-white hover-shadow transition" style="height: 150px; width: 230px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white p-2 me-3">
                                    <i class="fas fa-check-circle text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1"> Les demandes acceptées</h6>
                                    <h2 class="card-title mb-0">{{ $acceptedEnrollmentsCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 rounded-4 bg-secondary text-white hover-shadow transition" style="height: 150px; width: 230px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white p-2 me-3">
                                    <i class="fas fa-clock text-secondary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1"> les demandes en attente </h6>
                                    <h2 class="card-title mb-0">{{ $pendingEnrollmentsCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 rounded-4 bg-dark text-white hover-shadow transition" style="height: 150px; width: 230px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white p-2 me-3">
                                    <i class="fas fa-users text-dark fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle mb-1">Nombres total des utilisateurs</h6>
                                    <h2 class="card-title mb-0">{{ $usersCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Admin -->
            <div class="admin-message mt-5">
                <div class="card border-0 rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-4 fw-bold text-primary">
                            <i class="fas fa-bullhorn me-2"></i>Boite messageries
                        </h2>
                        @if(session('success'))
                            <div class="alert alert-success rounded-3 fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.message.store') }}">
                            @csrf
                            <div class="mb-3">
                                <textarea name="message" class="form-control rounded-3 border-2" rows="3"
                                    placeholder="Ecrire un message">{{ $message->message ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-3 px-4">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Message User -->
            <div class="user-message mt-4">
                <div class="card border-0 rounded-4 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-3 fw-bold text-primary">
                            <i class="fas fa-envelope me-2"></i>Message for Users
                        </h2>
                        <p class="card-text fs-5">{{ $message->message ?? 'No message available' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    function confirmLogout(event, formId) {
        event.preventDefault();
        if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
            document.getElementById(formId).submit();
        }
    }
</script>


<!-- Bootstrap + FontAwesome -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSS personnalisé -->
<style>
.hover-shadow {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.transition {
    transition: all 0.3s ease;
}
.card {
    overflow: hidden;
}
.nav-link {
    font-size: 1rem;
}
.nav-link:hover {
    background-color:
}