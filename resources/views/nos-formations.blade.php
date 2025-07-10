@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formations Créatives</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #ffffff;
      color: #000000;
      font-family: 'Segoe UI', sans-serif;
    }

    .section-title {
      color: #6c2bd9;
      font-weight: 600;
    }

    .main-title {
      font-size: 2rem;
      font-weight: bold;
    }

    .cta-btn {
      background: linear-gradient(to right, #7f00ff, #e100ff);
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 20px;
      font-weight: bold;
      box-shadow: 0 0 10px #a349ff;
    }

    .course-card {
      background-color: #f9f9f9;
      border-radius: 20px;
      padding: 25px;
      height: 100%;
      border: 2px solid #a349ff;
      transition: all 0.3s ease;
    }

    .course-card:hover {
      box-shadow: 0 0 15px rgba(163, 73, 255, 0.3);
    }

    .course-icon {
      width: 60px;
      margin-bottom: 15px;
    }

    .course-title {
      font-size: 1.3rem;
      font-weight: bold;
    }

    .course-link {
      color: #000;
      text-decoration: none;
      font-weight: 500;
    }

    .course-link:hover {
      text-decoration: underline;
      color: #a349ff;
    }
    .pagination-container {
  background: white;
  box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.page-link.custom-link {
  color: #5b00b7;
  font-weight: 500;
  border: none;
  background-color: transparent;
  position: relative;
}

.page-link.custom-link:hover {
  color: #ff2ebd;
}

.page-item.active .page-link.custom-link {
  color: #ff2ebd;
}

.page-item.active .page-link.custom-link::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 2px;
  transform: translateX(-50%);
  height: 3px;
  width: 15px;
  background: linear-gradient(to right, #ff2ebd, #8b5cf6);
  border-radius: 10px;
}

.page {
  display: none;
}

.page:not(.d-none) {
  display: block;
}
.border-purple {
  border-color: #a855f7 !important; /* violet */
}

.text-purple {
  color: #a855f7 !important;
}
.course-title {
  color: #000;
  font-weight: bold;
  font-size: 1.3rem;
  transition: all 0.3s ease;
}

.course-title:hover {
  background: linear-gradient(to right, #eb69d7, #9b4eb0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.page {
  display: none;
  opacity: 0;
  transition: opacity 0.5s ease;
}

.page:not(.d-none) {
  display: block;
  opacity: 1;
}
.border-gradient {
    border: 2px solid;
    border-image: linear-gradient(to right, #eb69d7, #9b4eb0) 1;
  }

  .border-violet {
    border: 2px solid #7a2ef7; /* Bordure violette */
  }
  .custom-card {
  background-color: #ffffff; /* Fond blanc */
  border: 2px solid;
  border-image: linear-gradient(to right, #ef85df, #9b4eb0) 1;
  border-radius: 20px;
  padding: 1.5rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  color: #000; /* Texte noir pour contraste sur fond blanc */
  transition: transform 0.2s ease;
  height: 100%;
}


    .custom-card:hover {
      transform: translateY(-5px);
    }

    .course-title {
      font-weight: bold;
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .hover-violet:hover {
      color: #9b5cf0;
    }
    .gradient-text {
        background: linear-gradient(to right, #eb69d7, #9b4eb0);
        -webkit-background-clip: text;
        color: transparent;
    }
      .custom-card {
    border-radius: 15px;
    background-color: #fff;
    border: 1px solid #df27ae;
    padding: 20px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* optionnel pour un effet stylé */
  }
  
</style>

  </style>
</head>
<body>
  <div class="container py-5">
    <h1 class="text-center mb-4 gradient-text"><strong>  Les métiers de l'avenir</strong></h1>
    <h4 class="text-center mb-5 fw-bold">Choisissez la formation qui vous convient<br>et rejoignez-nous dès maintenant.</h4>

    <!-- PAGE 1 -->
    
    <div class="container my-4 page" id="page-1">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Marketing digital – Maîtrisez les Stratégies de Communication en Ligne</h5>
            <p>Cette formation vous offre une compréhension approfondie des fondamentaux du marketing digital et vous dote des compétences clés pour concevoir et piloter des campagnes performantes.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation en Intelligence Artificielle – Machine Learning</h5>
            <p>Explorez les bases de l’IA avec une formation complète pour vous initier aux concepts essentiels et aux applications avancées comme la vision par ordinateur.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Design Graphique – Donnez vie à vos idées créatives</h5>
            <p>Maîtrisez Adobe Illustrator et Photoshop avec cette formation intensive en design graphique. Développez des compétences avancées en illustration digitale, retouche photo, mise en page, et branding, un véritable atout pour votre carrière professionnelle.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Data Analytics avec Power BI – Analysez vos données</h5>
            <p>Apprenez à transformer des données brutes en informations exploitables avec Power BI. Cette formation couvre la Business Intelligence (BI), les processus ETL, et la visualisation des données pour une prise de décision stratégique.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Algorithme : Python / C</h5>
            <p>Perfectionnez vos compétences en algorithmique et structures de données avec notre programme de formation spécialisé. Choisissez entre Python ou C pour une immersion totale dans les concepts clés, et apprenez à résoudre des problèmes complexes.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation de Programmation Orientée Objet en Java</h5>
            <p>Découvrez les principes essentiels de la programmation orientée objet avec notre formation complète en Java. Apprenez à concevoir et développer des applications robustes et maintenables grâce aux concepts clés de la POO.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation MERN</h5>
            <p>Notre formation MERN (MongoDB, Express.js, React et Node.js) intensive est conçue pour les développeurs souhaitant se spécialiser dans le développement full-stack. Vous apprendrez à maîtriser les technologies les plus récentes et à créer des applications web performantes et évolutives. Bénéficiez d’un accompagnement personnalisé par nos experts et de projets pratiques pour mettre en œuvre vos connaissances.</p>
          </div>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <img src="{{ asset('image/api.png') }}" alt="Illustration"
               class="img-fluid" style="max-width: 60%; height: auto;">
      </div>
      </div>
     
    </div>
    
    

    <!-- PAGE 2 -->
    <div class="container my-4 page d-none" id="page-2">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation WordPress – Créez et Gérez Votre Site Web</h5>
            <p>Apprenez à concevoir, personnaliser, et gérer des sites web modernes sans besoin de coder, grâce à WordPress, le CMS le plus utilisé.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation DevOps – Pratiquez les Outils pour un Déploiement Continu</h5>
            <p>Formation pratique avec Docker, Jenkins, GitLab... pour maîtriser les cycles de développement, l’automatisation et la gestion des conteneurs.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Initiation au Développement Web BACKEND</h5>
            <p>Découvrir le monde du développement web backend avec notre formation spécialisée de 30 heures en PHP et MySQL. Apprenez à créer et gérer les aspects essentiels de vos applications web côté serveur.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Initiation au Développement Web FRONTEND</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Angular et .NET</h5>
            <p>Maîtrisez le développement web full-stack avec Angular et .NET. Apprenez à créer des interfaces dynamiques et des backends robustes. Formation axée sur des projets concrets pour vous préparer aux défis réels du métier.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation Angular et Laravel</h5>
            <p>Rejoignez notre formation Angular et Laravel, disponible en présentiel et en ligne, et devenez un expert en développement d’applications web. Apprenez Angular pour des interfaces réactives et Laravel pour un backend sécurisé. Programme détaillé incluant API RESTful et sécurité.</p>
          </div>
        </div>
    
        <div class="col-md-4">
          <div class="custom-card">
            <h5 class="course-title hover-violet">Formation MEAN</h5>
            <p>Notre formation MEAN est un programme complet qui vous initie aux technologies essentielles pour créer des applications web modernes et performantes. Le stack MEAN (MongoDB, Express.js, Angular, Node.js) vous permet de maîtriser chaque aspect du développement, du frontend au backend.</p>
          </div>
         
        </div>
        <div class="col-md-6 text-center text-md-end">
          <img src="{{ asset('image/yyy.png') }}" alt="Illustration"
               class="img-fluid" style="max-width: 50%; height: auto;">
      </div>
      </div>
    </div>
    

    <!-- PAGINATION -->
    <div class="d-flex justify-content-between align-items-center border rounded p-3 mt-4">
      <span class="text-muted">Page <span id="current-page">1</span> sur 2</span>
      <ul class="pagination mb-0">
        <li class="page-item active"><a class="page-link custom-link" href="#" onclick="showPage(1)" aria-label="Page 1">1</a></li>
        <li class="page-item"><a class="page-link custom-link" href="#" onclick="showPage(2)" aria-label="Page 2">2</a></li>
      </ul>
    </div>
    

  <script>
    function showPage(pageNumber) {
      const pages = document.querySelectorAll('.page');
      pages.forEach(page => page.classList.add('d-none'));
  
      document.getElementById('page-' + pageNumber).classList.remove('d-none');
      document.getElementById('current-page').textContent = pageNumber;
  
      const pageLinks = document.querySelectorAll('.page-item');
      pageLinks.forEach(item => item.classList.remove('active'));
      pageLinks[pageNumber - 1].classList.add('active');
    }
  
    // THIS ensures it works only after the DOM is loaded
    window.onload = function () {
      showPage(1);
    }
  </script>

  
</body>






</html>
@endsection
