<?php
// On teste la connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=gsb_partners;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

session_start();

if (isset($_COOKIE['pseudo']) && isset($_COOKIE['role'])) {
    $_SESSION['pseudo'] = $_COOKIE['pseudo'];
    $_SESSION['role'] = $_COOKIE['role'];
}
?>
