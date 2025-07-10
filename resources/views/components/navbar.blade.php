
<style>
    body {
        background-color: #ffffff;
        color: #1C1F2A;
        margin: 0;
        padding: 0;
    }


    .btn-gradient {
        background: linear-gradient(135deg, #6B2D8C, #D6A4E0);
        color: white;
        font-weight: bold;
        border: none;
        padding: 10px 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transition: 0.3s;
        margin-left: 10px;
    }

    .btn-gradient:hover {
        opacity: 0.9;
    }


    .navbar {
        background-color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .navbar .nav-link {
        color: #1C1F2A !important;
        font-weight: 500;
    }

    .navbar .navbar-brand img {
        height: 45px;
    }

    .navbar .btn {
        margin-left: 10px;
    }

    /
    .hero-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 60px 10%;
        gap: 40px;
        flex-wrap: wrap;
    }

    .hero-text {
        flex: 1;
        max-width: 500px;
    }

    .hero-text h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #1C1F2A;
    }

    .hero-text p {
        font-size: 1.2rem;
        color: #333;
    }


    .hero-image {
        flex: 2;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .hero-image img {
        width: 100%;
        max-width: 700px;
        height: auto;
        transition: transform 0.3s ease;
    }

    .hero-image img:hover {
        transform: scale(1.05);
    }

    .gradient-text {
        background: linear-gradient(to right, #eb69d7, #9b4eb0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .navbar .nav-link:hover {
    color: #a20bf4e0 !important;
    transition: color 0.3s ease;
}
.btn-outline-light:hover {
    background-color: #b26acb !important;
    color: white !important;
    border-color: #b26acb !important;
}
.navbar .nav-link.active-link {
    color: #a954c5e8 !important;
    font-weight: bold;
}

        </style>
    </head>
    <body>

        @if (!isset($hideNavbar))
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('image/logoo.jpg') }}" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active-link' : '' }}" href="{{ url('/') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('a-propos') ? 'active-link' : '' }}" href="{{ url('/a-propos') }}">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('nos-formations') ? 'active-link' : '' }}" href="{{ url('/nos-formations') }}">Nos Formations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active-link' : '' }}" href="{{ url('/contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('chatbot.show') }}" class="nav-link {{ Request::is('chat') ? 'active-link' : '' }}">
                        <i class="fas fa-robot me-1"></i> ChatBot Assistant
                    </a>
                </li>
            </ul>

            @auth
                @php
                    $dashboardPath = auth()->user()->role_id === 1 ? '/dashboard' : (auth()->user()->role_id === 3 ? '/student-interface' : '/teacher-interface');
                @endphp
                <a href="{{ url($dashboardPath) }}" class="btn btn-gradient">Tableau de bord</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-gradient">
                        deconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-gradient"> Se Connecter</a>
                <a href="{{ route('register') }}" class="btn btn-gradient">S'inscrire</a>
            @endauth
        </div>
    </div>
</nav>
@endif
