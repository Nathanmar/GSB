<?php
// process_signup.php

require_once('connexion.php');

$nouveau_pseudo = $_POST['nouveau_pseudo'];
$nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
$confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];

// Vérifier si le pseudo existe déjà dans la base de données
$sql_check_user = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($sql_check_user);
$stmt->bindParam(':email', $nouveau_pseudo, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Le pseudo existe déjà, affichez un message d'erreur
    echo "Ce pseudo est déjà utilisé. Veuillez choisir un autre pseudo.";
} else {
    // Vérifier si les mots de passe correspondent
    if ($nouveau_mot_de_passe === $confirmer_mot_de_passe) {
        // Les mots de passe correspondent, ajoutez un nouvel utilisateur à la base de données
        $hashed_password = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);

        $sql_insert_user = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql_insert_user);
        $stmt->bindParam(':email', $nouveau_pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            // Utilisateur ajouté avec succès, redirigez-le vers la page d'accueil sécurisée
            header('Location: ../pages/index.php');
            exit();
        } else {
            // Erreur lors de l'ajout de l'utilisateur
            echo "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
        }
    } else {
        // Les mots de passe ne correspondent pas, affichez un message d'erreur
        echo "Les mots de passe ne correspondent pas. Veuillez les saisir à nouveau.";
    }
}
?>
