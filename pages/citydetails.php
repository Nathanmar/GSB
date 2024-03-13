<?php
require_once('includes/connexion.php');

// Vérifiez si l'ID de la ville est passé en paramètre GET
if (isset($_GET['id'])) {
    $cityId = $_GET['id'];

    // Effectuez une requête SQL pour récupérer le nom de la ville et du pays en fonction de l'ID
    $sql = "SELECT nom_laboratoire, nom_pays, image FROM villes WHERE id = :cityId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cityId', $cityId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $nomVille = $result['nom_laboratoire'];
        $nomPays = $result['nom_pays'];
        $images = explode(',', $result['image']);
        if (count($images) > 1) {
            $deuxiemeImage = $images[1];
        } else {
            $deuxiemeImage = 'assets/pictures/adn.jpg';
        }
    } else {
        // Gérez le cas où aucune ville n'a été trouvée avec cet ID
        echo "Aucune ville trouvée avec l'ID $cityId";
    }
} else {
    // Gérez le cas où l'ID de la ville n'est pas spécifié
    echo "ID de la ville non spécifié";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/city_details.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<header style="background-image: url('<?php echo $deuxiemeImage; ?>');">
        <nav>
        <img src="assets/pictures/logo.jpg" alt="Logo" class="logo">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="villes">Villes</a></li>
                <li><a href="map">Map</a></li>
                <li><a href="info">À Propos</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </nav>
        <div class="title">        
            <h1><?php echo $nomVille; ?></h1>
            <h2><?php echo $nomPays; ?></h2>
        </div>
    </header>
    
    <main>
        
    </main>
    
    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>


