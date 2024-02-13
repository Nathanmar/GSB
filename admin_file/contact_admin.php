<!-- admin_contacts.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_contact_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
    <div class="admin-sidebar">
        <!-- Colonne de navigation -->
        <img src="../assets/pictures/logo.jpg" alt="">
        <ul>
            <li><a href="map_admin.php">Map</a></li>
            <li><a href="villes_admin.php">Laboratoires</a></li>
            <li><a href="contact_admin.php">Contact</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <!-- Contenu principal -->
        <h1>Boîte de réception des messages</h1>

        <!-- Tableau pour afficher les données -->
        <table class="contact-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de connexion
                require_once('../includes/connexion.php');

                // Supprimer une ligne si une demande de suppression est reçue
                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'supprimer' && isset($_POST['id'])) {
                    $idToDelete = $_POST['id'];
                    $sql_delete_contact = "DELETE FROM contacts WHERE id = :id";
                    $stmt = $conn->prepare($sql_delete_contact);
                    $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);

                    try {
                        $stmt->execute();
                    } catch (PDOException $e) {
                        echo "Erreur lors de la suppression de la ligne : " . $e->getMessage();
                    }
                }

                // Requête SQL pour récupérer les données de la table "contacts"
                $query = "SELECT * FROM contacts";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $data = array();

                // Afficher les données dans le tableau
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                // Tri des données par ID
                usort($data, function($a, $b) {
                    return $a['id'] - $b['id'];
                });

                // Afficher les données triées dans le tableau
                foreach ($data as $row) {
                    echo "<tr class='contact-row' data-message='" . htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8') . "' data-id='" . $row['id'] . "'>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>";
                    echo "<form action='api/contact_api.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='action' value='supprimer'>";
                    echo "<button type='submit' class='delete-icon'><i class='fa-solid fa-xmark'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>    
        </table>

        <!-- Zone pour afficher le message -->
        <div id="message-container">
            <h2>Message</h2>
            <p id="message-content"></p>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var contactRows = document.querySelectorAll('tbody tr');

            contactRows.forEach(function(row) {
                row.addEventListener('click', function() {
                    // Retirez la classe active-hover de toutes les lignes
                    contactRows.forEach(function(row) {
                        row.classList.remove('active-hover');
                    });

                    // Ajoutez la classe active-hover à la ligne cliquée
                    this.classList.add('active-hover');

                    // Ajoutez ici le code pour marquer le message comme lu dans la base de données si nécessaire
                    var messageContent = this.getAttribute('data-message');
                    var contactId = this.getAttribute('data-id');
                    document.getElementById('message-content').textContent = messageContent;
                    document.getElementById('message-container').style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>
