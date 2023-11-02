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
    <title>UrbanVenture - Explorer les villes du monde</title>
</head>
<body>
    <div class="shadow-gradient"></div>
    <header>
        <nav>
        <img src="pictures/logo.jpg" alt="Logo" class="logo">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="villes">Villes</a></li>
                <li><a href="map">Map</a></li>
                <li><a href="info">À Propos</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>   
        </nav>
        <h1>Nos partenaires</h1>
    </header>
    <div class="search-bar">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Rechercher une ville ou un pays" class="search-input">
            </form>
        </div>
    <main>
    <section class="city-details">
            <?php
                while ($row = $result->fetch()) {
                    $images = explode(',', $row['image']);
                    $premiereimage = $images[0];
                    echo '<div class="city-card" style="background-image: url(' . $premiereimage . ');" data-id="' . $row['id'] . '">';
                    echo '<a href="citydetails.php?id=' . $row['id'] . '">';
                    echo '<div class="city-card-content">';
                    echo '<h2>' . $row['nom_ville'] ."," . '</h2>';
                    echo '<h2>' . $row['nom_pays'] . '</h2>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
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

        // Nouvelle fonction pour trier les villes
        function sortCities() {
            const sortByPriceCheckbox = document.getElementById('sortByPrice');
            const sortByPopularityCheckbox = document.getElementById('sortByPopularity');
            const sortByProximityCheckbox = document.getElementById('sortByProximity');

            const citiesArray = Array.from(cityCards); // Convertissez les cartes de ville en un tableau

            if (sortByPriceCheckbox.checked) {
                citiesArray.sort(function (a, b) {
                    // Vous devrez implémenter votre propre logique de tri par prix ici
                    // a et b représentent deux cartes de ville à comparer
                    // Triez-les en fonction du prix et renvoyez 1, -1 ou 0 en conséquence
                });
            } else if (sortByPopularityCheckbox.checked) {
                citiesArray.sort(function (a, b) {
                    // Vous devrez implémenter votre propre logique de tri par popularité ici
                    // a et b représentent deux cartes de ville à comparer
                    // Triez-les en fonction de la popularité et renvoyez 1, -1 ou 0 en conséquence
                });
            } else if (sortByProximityCheckbox.checked) {
                citiesArray.sort(function (a, b) {
                    // Vous devrez implémenter votre propre logique de tri par proximité ici
                    // a et b représentent deux cartes de ville à comparer
                    // Triez-les en fonction de la proximité et renvoyez 1, -1 ou 0 en conséquence
                });
            }

            // Réinsérez les cartes triées dans la section city-details
            const cityDetails = document.querySelector('.city-details');
            cityDetails.innerHTML = ''; // Effacez les cartes actuelles

            citiesArray.forEach(function (card) {
                cityDetails.appendChild(card); // Réinsérez les cartes triées
            });
        }

        // Écoutez les événements "change" sur les cases à cocher de tri
        document.getElementById('sortByPrice').addEventListener('change', sortCities);
        document.getElementById('sortByPopularity').addEventListener('change', sortCities);
        document.getElementById('sortByProximity').addEventListener('change', sortCities);

    </script>
    
    <footer>
        <p>&copy; 2023 UrbanVenture. Tous droits réservés.</p>
    </footer>
</body>
</html>
