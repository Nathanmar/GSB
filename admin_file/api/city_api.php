<?php
// Inclure le fichier de connexion
require_once('../../includes/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'ajouter':
                // Récupérez les données du formulaire
                $nom_ville = $_POST['nouvelle_ville'];
                $nom_pays = $_POST['nouveau_pays'];
                $description = $_POST['nouvelle_description'];
                $image = $_POST['nouvelle_image'];

                // Exécutez une requête SQL pour insérer les données dans la table "villes"
                $query = "INSERT INTO villes (nom_ville, nom_pays, description, image) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->execute([$nom_ville, $nom_pays, $description, $image]);
                break;

            case 'supprimer':
                // Récupérez l'ID de la ligne à supprimer
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    // Exécutez une requête SQL pour supprimer la ligne de la table "villes"
                    $query = "DELETE FROM villes WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id]);
                }
                break;

                case 'modifier':
                    // Récupérez les données du formulaire caché
                    $id = $_POST['id'];
                    $nom_ville = $_POST['nouvelle_ville'];
                    $nom_pays = $_POST['nouveau_pays'];
                    $description = $_POST['nouvelle_description'];
                    $image = $_POST['nouvelle_image'];
    
                    // Exécutez une requête SQL pour mettre à jour la ligne dans la table "villes"
                    $query = "UPDATE villes SET nom_ville = ?, nom_pays = ?, description = ?, image = ? WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$nom_ville, $nom_pays, $description, $image, $id]);
                break;

            default:
                echo "Action non reconnue.";
                break;
        }

        // Redirigez l'utilisateur vers la page d'administration des villes après l'action
        header("Location: ../villes_admin.php");
    } else {
        echo "Action non spécifiée.";
    }
} else {
    echo "Une erreur s'est produite lors de la soumission du formulaire.";
}
?>
