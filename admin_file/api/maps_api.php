<?php
// Inclure le fichier de connexion
require_once('../../includes/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'ajouter':
                // Récupérez les données du formulaire
                $name = $_POST['nouveau_name'];
                $lat = $_POST['nouvelle_lat'];
                $lng = $_POST['nouvelle_lng'];

                // Exécutez une requête SQL pour insérer les données dans la table "villes"
                $query = "INSERT INTO maps ( name, lat, lng) VALUES ( ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->execute([ $name, $lat, $lng]);
                break;

            case 'supprimer':
                // Récupérez    'ID de la ligne à supprimer
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    // Exécutez une requête SQL pour supprimer la ligne de la table "villes"
                    $query = "DELETE FROM maps WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id]);
                }
                break;

                case 'modifier':
                    // Récupérez les données du formulaire caché
                    $id = $_POST['id'];
                    $name = $_POST['nouveau_name'];
                    $lat = $_POST['nouvelle_lat'];
                    $lng = $_POST['nouvelle_lng'];
    
                    // Exécutez une requête SQL pour mettre à jour la ligne dans la table "villes"
                    $query = "UPDATE maps SET name = ?, lat = ?, lng = ? WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$name, $lat, $lng, $id]);
                break;

            default:
                echo "Action non reconnue.";
                break;
        }

        // Redirigez l'utilisateur vers la page d'administration des villes après l'action
        header("Location: ../map_admin.php");
    } else {
        echo "Action non spécifiée.";
    }
} else {
    echo "Une erreur s'est produite lors de la soumission du formulaire.";
}
?>
