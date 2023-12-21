<?php 

require_once('includes/connexion.php');

$sql = "SELECT * FROM villes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/city_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>GSB - Explorer les villes du monde</title>
</head>
<body>
    <div class="shadow-gradient"></div>
    <header>
        <nav>
        <img src="assets/pictures/logo.jpg" alt="Logo" class="logo">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="villes">Villes</a></li>
                <li><a href="map">Map</a></li>
                <li><a href="info">Paramètres</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>   
        </nav>
        <h1>Nos partenaires</h1>
    </header>
    <div class="search-bar">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Rechercher un laboratoire" class="search-input" autocomplete="off">
            </form>
        </div>
    <main>
    <section class="city-details">
            <?php
                while ($row = $result->fetch()) {
                    $images = explode(',', $row['image']);
                    $premiereimage = $images[0];
                    echo '<div class="city-card" style="background-image: url(assets/pictures/' . $premiereimage . ');" data-id="' . $row['id'] . '">';
                    echo '<a href="' . $row['liens'] . '" target="_blank">';
                    echo '<div class="city-card-content">';
                    echo '<h2>' . $row['nom_ville'] ."," . '</h2>';
                    echo '<h2>' . $row['nom_pays'] . '</h2>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                    echo '<script>';
                    echo 'console.log(' . json_encode($row) . ');';
                    echo '</script>';
                }
            ?>
        </section>
    </main>

    <script>
        // Récupérez la référence de l'élément d'entrée de recherche
        const searchInput = document.querySelector('input[name="search"]');
        const cityCards = document.querySelectorAll('.city-card');

        // Écoutez l'événement "input" sur l'élément d'entrée de recherche
        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.trim().toLowerCase();

            // Parcourez toutes les cartes de ville et affichez ou masquez en fonction du terme de recherche
            cityCards.forEach(function (card) {
                const cityTitle = card.querySelector('h2:first-of-type').textContent.toLowerCase();
                const countryTitle = card.querySelector('h2:last-of-type').textContent.toLowerCase();

                if (cityTitle.includes(searchTerm) || countryTitle.includes(searchTerm) ) {
                    card.style.display = 'block'; // Afficher la carte
                } else {
                    card.style.display = 'none'; // Masquer la carte
                }
            });
        });

    </script>
    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>
