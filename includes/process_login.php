<?php
// process_login.php


require_once('connexion.php');

$pseudo = $_POST['pseudo'];
$mot_de_passe = $_POST['mot_de_passe'];

// Vérifier si l'utilisateur existe déjà dans la base de données
$sql_check_user = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($sql_check_user);
$stmt->bindParam(':email', $pseudo, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // L'utilisateur existe, vérifiez le mot de passe
    $password_hash = $user['password'];

    if (password_verify($mot_de_passe, $password_hash)) {
        session_start(); // Démarrez la session si elle n'est pas déjà démarrée
        $_SESSION['pseudo'] = $pseudo; // Stockez le pseudo de l'utilisateur dans la session
        $_SESSION['role'] = $user['role']; // Stockez le rôle de l'utilisateur dans la session

        // Le mot de passe est correct, vous pouvez rediriger l'utilisateur vers la page d'accueil sécurisée
        header('Location: ../index.php');
        exit();
    } else {
        // Le mot de passe est incorrect, affichez un message d'erreur
        echo "Mot de passe incorrect. Veuillez réessayer.";
    }
} else {
    // L'utilisateur n'existe pas, vous pouvez ajouter un nouvel utilisateur à la base de données
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $sql_insert_user = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql_insert_user);
    $stmt->bindParam(':email', $pseudo, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        // Utilisateur ajouté avec succès, redirigez-le vers la page d'accueil sécurisée
        header('Location: ../index.php');
        exit();
    } else {
        // Erreur lors de l'ajout de l'utilisateur
        echo "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
    }
}

?>
