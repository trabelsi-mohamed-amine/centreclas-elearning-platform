<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interface ADMIN</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
   @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
}

:root {
  --purple: #b26acb;
  --white: #fff;
}

body {
  background: #f2f2f2;
  min-height: 100vh;
}

/* Sidebar */
.navigation {
  position: fixed;
  width: 260px;
  height: 100%;
  background: var(--purple);
  overflow: hidden;
}

.navigation ul {
  list-style: none;
  padding: 0;
  margin-top: 20px;
}

.navigation ul li {
  position: relative;
  width: 100%;
  margin-bottom: 10px;
}

.navigation ul li a {
  display: flex;
  align-items: center;
  color: var(--white);
  text-decoration: none;
  padding: 12px 20px;
  transition: 0.3s ease;
}

.navigation ul li a .icon {
  min-width: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.navigation ul li a .icon ion-icon {
  font-size: 1.5rem;
}

.navigation ul li a .title {
  margin-left: 10px;
  font-size: 1rem;
  white-space: nowrap;
}

/* Sidebar hover effect */
.navigation ul li:hover a,
.navigation ul li.hovered a {
  color: var(--purple);
  background-color: var(--white);
  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}

.navigation ul li:hover a::before,
.navigation ul li.hovered a::before {
  content: '';
  position: absolute;
  right: 0;
  top: -50px;
  width: 50px;
  height: 50px;
  background: transparent;
  border-radius: 50%;
  box-shadow: 35px 35px 0 10px var(--white);
}

.navigation ul li:hover a::after,
.navigation ul li.hovered a::after {
  content: '';
  position: absolute;
  right: 0;
  bottom: -50px;
  width: 50px;
  height: 50px;
  background: transparent;
  border-radius: 50%;
  box-shadow: 35px -35px 0 10px var(--white);
}

/* Topbar */
.topbar {
  position: fixed;
  left: 260px;
  width: calc(100% - 260px);
  height: 60px;
  background: #f2f2f2;
  display: flex;
  align-items: center;
  padding: 0 20px;
  z-index: 10;
  justify-content: center;
}

/* Search */
.search {
  position: relative;
  width: 400px;
  max-width: 100%;
  margin-left: auto;
}

.search label {
  width: 100%;
  position: relative;
}

.search label input {
  width: 100%;
  padding: 10px 20px 10px 40px;
  border-radius: 20px;
  border: 1px solid #b26acb;
  outline: none;
  font-size: 16px;
  background: #fff;
}

.search label ion-icon {
  position: absolute;
  top: 10px;
  left: 12px;
  font-size: 1.2rem;
  color: #333;
}

.d-flex {
    display: flex;
    min-height: 100vh;
}

main {
    flex-grow: 1;
    padding: 20px;
}

aside {
    width: 260px;
    background-color: white;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="navigation">
    <ul>
      <li style="padding: 0 20px; margin-bottom: 30px;">
        <span style="color: white; font-size: 1.2rem; font-weight: bold;">CentreCLAS</span>
      </li>
      <li>
        <a href="#">
          <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
          <span class="title">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('sessions.index') }}">
          <span class="icon"><ion-icon name="receipt-outline"></ion-icon></span>
          <span class="title"> Les Sessions</span>
        </a>
      </li>
      <li>
        <a href="{{ route('teachers.index') }}">
          <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
          <span class="title">Les Formateurs</span>
        </a>
      </li>
      <li>
        <a href="{{ route('students.index') }}">
          <span class="icon"><ion-icon name="school-outline"></ion-icon></span>
          <span class="title">Les Étudiants</span>
        </a>
      </li>
      <li class="logout">
        <a href="logout.html">
          <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
          <span class="title">Déconnexion</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- Topbar -->
  <div class="topbar">
    <div class="search">
      <label>
        <input type="text" placeholder="Search here">
        <ion-icon name="search-outline"></ion-icon>
      </label>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Hover effect
    let liste = document.querySelectorAll(".navigation li");

    function activelink() {
      liste.forEach((item) => item.classList.remove("hovered"));
      this.classList.add("hovered");
    }

    liste.forEach((item) => item.addEventListener("mouseover", activelink));
  </script>

  <!-- Ionicons CDN -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
