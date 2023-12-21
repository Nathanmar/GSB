<?php
// contact.php

// Incluez le fichier de connexion à la base de données
require_once('includes/connexion.php');

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Préparez et exécutez la requête d'insertion
    $sql_insert_contact = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $conn->prepare($sql_insert_contact);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $success_message = "Le message a été envoyé avec succès.";
    } catch (PDOException $e) {
        $error_message = "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/contact_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>GSB</title>
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
        <h1>Notre formulaire de contact</h1>
        <?php
        // Afficher le message de succès ou d'erreur
        if (isset($success_message)) {
            echo '<p style="color: green;">' . $success_message . '</p>';
        } elseif (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>
        <form action="contact.php" method="post">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <input type="submit" value="Envoyer">
        </form>
    </main>
    
    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>
