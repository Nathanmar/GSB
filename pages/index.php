<?php 

require_once('../includes/connexion.php');
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const burgerMenu = document.querySelector('.burger-menu');
        const nav = document.querySelector('header nav');

        burgerMenu.addEventListener('click', function () {
            console.log("test");
            nav.classList.toggle('show');
        });
    });
</script>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>GSB, nos partenaires</title>
</head>
<body>
    <header>
        <img src="../assets/pictures/logo.jpg" alt="Logo" class="logo">

        <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
        <nav id="nav-bar">
            <ul class="menu">
                <li class="nav-link"><a href="index.php">Accueil</a></li>
                <li class="nav-link"><a href="villes">Partenaires</a></li>
                <li class="nav-link"><a href="map">Map</a></li>
                <li class="nav-link"><a href="info">Paramètres</a></li>
                <li class="nav-link"><a href="contact">Contact</a></li>
            </ul>
        </nav>
        <h1 class="h1top">Galaxy Swiss Bourdin</h1>
    </header>
    
    <main>
        <div class="text">
            <h2>Bienvenue sur le site de Galaxy Swiss Bourdin (GSB) - Votre partenaire en santé</h2>
            <p class="text-para">GSB, un leader de l'industrie pharmaceutique, est ravi de vous accueillir sur notre site dédié à nos précieux partenaires. Notre engagement envers la santé et l'innovation nous a conduit à collaborer avec des laboratoires pharmaceutiques renommés à travers le monde. Ces partenariats stratégiques sont au cœur de notre mission qui consiste à améliorer la qualité de vie des patients grâce à des solutions médicales de pointe.</p>
        </div>
        <img class="imgtop" src="../assets/pictures/adn.jpg" alt="image adn">
        <div class="text">
            <h2 class="title">Nos Partenaires Pharmaceutiques</h2>
            <p class="text-para">Nos partenariats avec d'autres laboratoires pharmaceutiques de renommée mondiale sont essentiels pour notre succès. Ensemble, nous travaillons sur des projets de recherche et de développement qui repoussent les limites de la science médicale. Ces collaborations visent à créer des solutions innovantes pour lutter contre les maladies, améliorer la qualité de vie des patients et façonner l'avenir de la santé.</p>
        </div>
    </main>
    
    <footer>
        <p> &copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>

