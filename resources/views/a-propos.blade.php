@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CLAS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      background: white;
      font-family: 'Segoe UI', sans-serif;
    }
    .gradient-text {
      background: linear-gradient(to right, #eb69d7, #9b4eb0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .icon-box {
      background: #fff;
      border-radius: 1rem;
      padding: 30px;
      text-align: center;
      border: 1px solid #eb69d7;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .icon-box i {
      font-size: 40px;
      color: #9b4eb0;
      margin-bottom: 15px;
    }
    .btn-pink {
      background-color: #eb69d7;
      color: white;
      font-weight: bold;
    }
    .btn-pink:hover {
      background-color: #d355c2;
      color: white;
    }
    .section-title {
      color: #000;
    }
    .violet-link {
  color: #9b4eb0 !important;
}
.gradient-title {
    background: linear-gradient(to right, #9b4eb0, #eb69d7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .violet-button {
  background-color: #9b4eb0;
  color: white;
  font-weight: bold;
  border: none;
}

.violet-button:hover {
  background-color: #eb69d7;
  color: white;
}
.text-primary {
  color: #9b4eb0; 
}



  </style>
</head>
<body>

<!-- Section 1: Qui sommes-nous -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start" style="padding-left: 150px;">
            <img src="{{ asset('image/ttt.png') }}" alt="Illustration"
                 class="img-fluid" style="max-width: 90%; height: auto;">
        </div>
      <div class="col-md-6">
        <h6 class="gradient-text"><strong>CentreCLAS</strong></h6>
        <h3 class="fw-bold section-title gradient-title">QUI SOMMES NOUS ?</h3>
        <p><strong>CentreCLAS est un centre de formation professionnel propose des formations dans les métiers du multimédia et de l’informatique, à savoir :</strong></p>
        <p><strong>Marketing digital,Intelligence Artificielle,Design Graphique , Data Analytics avec Power BI,Algorithme : Python / C,Programmation Orientée Objet en Java,MERN,WordPress,DevOps,Initiation au Développement Web BACKEND,Initiation au Développement Web FRONTEND,Angular et .NET,Angular et Laravel et Formation MEAN...</strong></p>
        <a href="{{ url('/nos formations') }}" class="btn violet-button mt-3">
            <i class="bi bi-person-plus-fill me-2"></i>Join For Free
          </a>

    </div>
    </div>
  </div>
</section>

<!-- Section 2: Avantages -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-3">
        <div class="icon-box">
          <i class="bi bi-cpu"></i>
          <h5 class="fw-bold">Apprenez Les Nouvelles Technologies</h5>
          <p>Maîtriser les compétences les plus récentes et les nouvelles technologies.</p>
          <a class="nav-link violet-link" href="{{ url('/nos formations') }}"><strong>Start Now!</strong></a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="icon-box">
          <i class="bi bi-display"></i>
          <h5 class="fw-bold">Apprenez à Votre Rythme</h5>
          <p>Chacun préfère apprendre à son propre rythme, ce qui conduit à des résultats excellents.</p>
          <a class="nav-link violet-link" href="{{ url('/nos formations') }}"><strong>Start Now!</strong></a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="icon-box">
          <i class="bi bi-shield-check"></i>
          <h5 class="fw-bold">Apprenez avec des Experts</h5>
          <p>Des enseignants expérimentés peuvent accélérer votre apprentissage.</p>
          <a class="nav-link violet-link" href="{{ url('/nos formations') }}"><strong>Start Now!</strong></a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="icon-box">
          <i class="bi bi-rocket-takeoff"></i>
          <h5 class="fw-bold">Profitez d’un Stage</h5>
          <p>Bénéficiez d’un stage pour enrichir votre expérience pratique.</p>
          <a class="nav-link violet-link" href="{{ url('/nos formations') }}"><strong>Start Now!</strong></a>

         </div>
      </div>
    </div>
  </div>
</section>

<!-- Section 3: Pourquoi Nos Formations -->
<section class="py-5 bg-white">
    <div class="container">
      <h2 class="text-center fw-bold mb-5 section-title"><span class="gradient-text"> Pourquoi Nos Formations?</span></h2>
      <div class="row align-items-center bg-light text-dark rounded-4 shadow p-4" style="border: 2px solid #9b4eb0;">
          <div class="col-md-6 text-center text-md-start" style="padding-left: 150px;">
              <img src="{{ asset('image/fem.png') }}" alt="Illustration"
                   class="img-fluid" style="max-width: 80%; height: auto;">
          </div>
        <div class="col-md-6">
            <h6 class="gradient-text"><strong>PROJECT-BASED</strong></h6>
          <h2 class="fw-bold">Développez des bases solides grâce à notre approche <span class="text-violet">"PROJECT-BASED"</span></h2>
          <p>Participez à une formation conçue par des experts, où vous travaillerez sur des projets concrets pour acquérir des compétences pratiques et actionnables. Construisez un portfolio impressionnant et démarquez-vous lors de votre recherche d'emploi.</p>
          <a href="{{ url('/nos formations') }}" class="btn violet-button mt-3">
            <i class="bi bi-person-plus-fill me-2"></i>Join For Free
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-white">
    <div class="container">

      <div class="row align-items-center bg-light text-dark rounded-4 shadow p-4" style="border: 2px solid #9b4eb0;">
          <div class="col-md-6 text-center text-md-start" style="padding-left: 150px;">
              <img src="{{ asset('image/debb.png') }}" alt="Illustration"
                   class="img-fluid" style="max-width: 80%; height: auto;">
          </div>
        <div class="col-md-6">
            <h6 class="gradient-text"><strong>DES EXPERTS DU SECTEUR</strong></h6>

          <h3 class="fw-bold">Apprenez auprès d'experts du secteur</h3>
          <p>Chez Centre CLAS, vous ne suivez pas simplement des cours ; vous bénéficiez d'un véritable partenariat avec des experts passionnés. Nos formateurs sont là pour vous guider, répondre à vos questions, et vous aider à surmonter les défis. Nous nous engageons à vous offrir un encadrement attentif et personnalisé. </p>
          <p>Profitez de l'expérience et des connaissances de professionnels du secteur qui se consacrent pleinement à votre réussite et à votre développement professionnel.</p>
          <a href="{{ url('/nos formations') }}" class="btn violet-button mt-3">
            <i class="bi bi-person-plus-fill me-2"></i>Join For Free
          </a>
        </div>
      </div>
    </div>
  </section>


  <section class="py-5 bg-white">
    <div class="container">
      <div class="row align-items-center bg-light text-dark rounded-4 shadow p-4" style="border: 2px solid #9b4eb0;">
          <div class="col-md-6 text-center text-md-start" style="padding-left: 150px;">
              <img src="{{ asset('image/debbb.png') }}" alt="Illustration"
                   class="img-fluid" style="max-width: 80%; height: auto;">
          </div>
        <div class="col-md-6">
            <h6 class="gradient-text"><strong>ACCESSIBLE AUX DEBUTANTS</strong></h6>
          <h3 class="fw-bold">Nos Formations sont Accessible<span class="text-violet">"aux Débutants"</span></h3>
          <p>Dans notre centre de formation, nous croyons que chacun peut apprendre et réussir, quel que soit son point de départ. Nos cours sont conçus pour les débutants, garantissant que même ceux sans expérience préalable peuvent facilement suivre et développer leurs compétences.</p>
          <p>Nous offrons des instructions étape par étape, une pratique concrète, et un soutien continu pour vous aider à vous sentir confiant et capable tout au long de votre parcours.</p>
          <a href="{{ url('/nos formations') }}" class="btn violet-button mt-3">
            <i class="bi bi-person-plus-fill me-2"></i>Join For Free
          </a>
        </div>
      </div>
    </div>
  </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection
