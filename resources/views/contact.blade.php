@extends('layouts.app')

@section('content')

<div class="container py-5 position-relative">
    <!-- Image en haut à droite -->
    <img src="{{ asset('image/cont.png') }}" alt="Illustration"
         class="img-fluid position-absolute top-0 end-0" style="width: 
         38%; height: auto;">
    
    <h3 class="text-center mb-2 gradient-text" style="width: 34%; margin-left: 0;"><strong>Contactez-Nous </strong></h3>
             <h4 class="text-start mb-5 fw-bold"> Pour commencer une Aventure Educative<br></h4>
         
    <div class="contact-card w-100">


        <!-- Adresse, Contact et Email en disposition verticale -->
        <div class="contact-info">
            <!-- Adresse -->
            <div class="d-flex align-items-start mb-4">
                <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                <div>
                    <h5>Adresse</h5>
                    <p>Route de Teniour Km 5.5 - Teboulbi - Sfax</p>
                </div>
            </div>

            <!-- Contact -->
            <div class="d-flex align-items-start mb-4">
                <div class="icon-box"><i class="bi bi-telephone-fill"></i></div>
                <div>
                    <h5>Contact</h5>
                    <p>
                        Mobile : <a href="tel:+21656011140">+216 56011140</a><br>
                        Phone : <a href="tel:+21654000021">+216 54000021</a>
                    </p>
                </div>
            </div>

            <!-- Email -->
            <div class="d-flex align-items-start">
                <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <h5>E-mail</h5>
                    <p>
                        Mail : <a href="mailto:contact@centreclas.com">contact@centreclas.com</a><br>
                        Gmail : <a href="mailto:centreclas@gmail.com">centreclas@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    body {
        background-color: #f2f2f2;
        font-family: 'Segoe UI', sans-serif;
    }

    .contact-card {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 40px;
        max-width: 800px;
    }

    .icon-box {
        font-size: 28px;
        color: #9b4eb0;
        margin-right: 15px;
    }

    .contact-info h5 {
        font-weight: bold;
        color: #9b4eb0;
    }

    .contact-info a {
        color: #eb69d7;
        text-decoration: none;
    }

    .contact-info a:hover {
        text-decoration: underline;
    }

    h2.title {
        text-align: left; /* Titre aligné à gauche */
        color: #9b4eb0;
        font-weight: bold;
        margin-bottom: 30px;
    }
</style>

<!-- Bootstrap & Icons (si pas inclus dans ton layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
