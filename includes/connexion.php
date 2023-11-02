<?php
// On teste la connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=gsb_partners;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
