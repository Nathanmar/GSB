<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/map_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <title>GSB - Explorer les villes du monde</title>
</head>
<body>
    <div class="shadow-gradient"></div>
    <header>
        <nav>
            <img src="assets/pictures/logo.jpg" alt="Logo" class="logo">
            <div class=pin-container>
            <input type="text" id="citySearch" class="citySearch" placeholder="Rechercher un laboratoire" list="citySuggestions" />
            <datalist id="citySuggestions"></datalist>
            </div>
            <ul>

                <li><a href="index.php">Accueil</a></li>
                <li><a href="villes">Villes</a></li>
                <li><a href="map">Map</a></li>
                <li><a href="info">Paramètres</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div id="map"></div>
    </main>
    <script>
    var map = L.map('map', {
        center: [48.8566, 10.3522], // Coordonnées de départ
        zoom: 5, // Niveau de zoom initial
        zoomControl: false // Désactiver les boutons de zoom
    });

    L.tileLayer('https://api.maptiler.com/maps/satellite/{z}/{x}/{y}.jpg?key=mdK8k0mppVd1no4KQH8x', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var cities = <?php
        require_once("includes/connexion.php");

        $query = $conn->prepare("SELECT name, lat, lng FROM maps");
        $query->execute();
        $cities = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($cities); // Convertit les données en format JSON

        ?>;

        var citySearchInput = document.getElementById('citySearch');
        var citySuggestionsDatalist = document.getElementById('citySuggestions');

        // Générez les options de la datalist à partir des données de 'cities'
        cities.forEach(function(city) {
            var marker = L.marker([city.lat, city.lng]).addTo(map);
            marker.bindPopup(city.name);
            var option = document.createElement('option');
            option.value = city.name;
            citySuggestionsDatalist.appendChild(option);
        });

        citySearchInput.addEventListener('input', function () {
            var searchValue = citySearchInput.value.toLowerCase();
            var city = cities.find(function (c) {
                return c.name.toLowerCase() === searchValue;
            });

            if (city) {
                map.setView([city.lat, city.lng], 20); // Centrer la carte sur la ville
            }
        });
    </script>
    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>

