<?php
// info.php

// Démarrez la session pour accéder aux données de session
session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant la présence du pseudo dans la session
if (isset($_SESSION['pseudo'])) {
    $pseudo = $_SESSION['pseudo'];
    // Maintenant, vous pouvez utiliser $pseudo pour afficher le pseudo de l'utilisateur
} else {
    // L'utilisateur n'est pas connecté, vous pouvez rediriger vers la page de connexion ou afficher un message
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/param_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>GSB partners</title>
</head>
<body>
    <header>
        <nav>
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
        <h1>Paramètres</h1>
        <?php
        // Affichez le pseudo de l'utilisateur connecté
        echo "<p class='user-info'>Connecté en tant que : " . $pseudo . "</p>";
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            // L'utilisateur a le rôle "admin", affichez le bouton d'administration
            echo '<a href="admin_file/map_admin.php" class="admin-button" target="_blank">Accéder à la page administrateur</a>';
        }
        ?>

        <form method="post" action="includes/process_logout.php">
            <input type="submit" name="logout" value="Se déconnecter" class="logout-button">
        </form>
    </main>
    
    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>