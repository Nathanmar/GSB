<?php
// Inclure le fichier de connexion
require_once('../../includes/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {


            case 'supprimer':
                // Récupérez l'ID de la ligne à supprimer
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    // Exécutez une requête SQL pour supprimer la ligne de la table "villes"
                    $query = "DELETE FROM contacts WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id]);
                }
                break;

            default:
                echo "Action non reconnue.";
                break;
        }

        header("Location: ../contact_admin.php");
    } else {
        echo "Action non spécifiée.";
    }
} else {
    echo "Une erreur s'est produite lors de la soumission du formulaire.";
}
?>
