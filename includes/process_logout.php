<?php
// process_logout.php


require_once('connexion.php');

$pseudo = $_POST['pseudo'];
$mot_de_passe = $_POST['mot_de_passe'];

// Vérifier si l'utilisateur existe déjà dans la base de données
$sql_check_user = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($sql_check_user);
$stmt->bindParam(':email', $pseudo, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['logout'])) {

    setcookie('pseudo', '', time() - 3600, '/');
    setcookie('role', '', time() - 3600, '/');
    
    session_start(); // Démarrez la session si elle n'est pas déjà démarrée
    session_destroy(); // Détruisez toutes les données de session

    // Rediriger vers la page de connexion
    header('Location: ../pages/login.php');
    exit();
}

?>
