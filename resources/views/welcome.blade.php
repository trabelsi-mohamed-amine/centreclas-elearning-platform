@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Texte à gauche -->
        <div class="col-md-6">
            <h1>
                <span class="gradient-text"> <strong>Préparez vous à l'avenir</strong></span>
            </h1>
            <p class="mt-4 fs-5">
                Au Centre CLAS, chaque formation est une passerelle vers l’excellence.
                Grâce à une pédagogie innovante et centrée sur la pratique, nous préparons les esprits curieux et ambitieux à relever les défis d’un monde en constante évolution.
            </p>
        </div>

        <!-- Image à droite -->
        <div class="col-md-6 text-center text-md-end">
            <img src="{{ asset('image/fff.png') }}" alt="Illustration"
                 class="img-fluid" style="max-width: 130%; height: auto;">
        </div>
    </div>
</div>
@endsection
