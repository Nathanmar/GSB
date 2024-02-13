<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_map_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
    <div class="admin-sidebar">
    <img src="../assets/pictures/logo.jpg" alt="">
        <ul>
            <li><a href="map_admin.php">Map</a></li>
            <li><a href="villes_admin.php">Laboratoires</a></li>
            <li><a href="contact_admin.php">Contact</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <h1>Page d'administration de la map</h1>
        <table>
            <tbody>
                <?php
                // Inclure le fichier de connexion
                require_once('../includes/connexion.php');

                // Récupérer les données de la table "maps"
                $query = "SELECT * FROM maps";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                usort($data, function ($a, $b) {
                    return $a['id'] - $b['id'];
                });
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Laboratoire</th>";
                echo "<th>lat</th>";
                echo "<th>lng</th>";
                echo "</tr>";
                echo "</thead>";
                
                // Afficher les données
                echo "<tbody>";
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><input type='text' class='editable' value='" . $row['name'] . "' disabled></td>";
                    echo "<td><input type='text' class='editable' value='" . $row['lat'] . "' disabled></td>";
                    echo "<td><input type='text' class='editable' value='" . $row['lng'] . "' disabled></td>";
                    echo "<td>";
                    echo "<form action='api/maps_api.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='action' value='supprimer'>";
                    echo "<button type='submit'><i class='fa-solid fa-xmark'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='button' onclick='editRow(this)'><i class='fa-solid fa-pencil'></i></button>";
                    echo "<button type='button' onclick='saveRow(this)' style='display: none;'><i class='fa-solid fa-check'></i></button>";
                    echo "</td>";
                    echo "</tr>";
                }
                
                // Fermer la table
                echo "</tbody>";
                echo "</table>";
                ?>
        <button class="add_marker" id="addMarkerButton" onclick="addmarker()">Ajouter un marqueur <i class='fa-solid fa-plus'></i></button>
        <!-- Formulaire pour ajouter une ville à la base de données -->
        <form  id="ajoutMarkerForm" action="api/maps_api.php" style="display:none;" method="POST">
            <input type="hidden" name="action" value="ajouter"> <!-- Action d'ajout -->
            <h2>Ajouter un nouveau marqueur</h2>
            <label for="nouveau_name">Nom du laboratoire:</label>
            <input name="nouveau_name" id="nouveau_name" required>
            <label for="nouvelle_lat">latitude:</label>
            <input type="text" name="nouvelle_lat" id="nouvelle_lat" required>
            <label for="nouvelle_lng">longitude:</label>
            <input type="text" name="nouvelle_lng" id="nouvelle_lng" required>
            <!-- Bouton pour soumettre le formulaire -->
            <button class="add_marker" type="submit">Valider <i class='fa-solid fa-plus'></i></button>
        </form>

        <form id="modificationForm" action="api/maps_api.php" method="POST" style="display: none;">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" id="idField" name="id" value="">
            <input type="hidden" id="nameField" name="nouveau_name" value="">
            <input type="hidden" id="latField" name="nouvelle_lat" value="">
            <input type="hidden" id="lngField" name="nouvelle_lng" value="">
        </form>
    </div>

    <script>
    function addmarker() {
        var ajoutMarkerForm = document.getElementById('ajoutMarkerForm');
        if (ajoutMarkerForm.style.display === 'none' || ajoutMarkerForm.style.display === '') {
            ajoutMarkerForm.style.display = 'block';
        } else {
            ajoutMarkerForm.style.display = 'none';
        }
    }

    function editRow(button) {
        var row = button.closest('tr');
        var editableCells = row.getElementsByClassName('editable');
        for (var i = 0; i < editableCells.length; i++) {
            editableCells[i].disabled = false;
        }
        button.style.display = 'none';
        row.querySelector('button[onclick="saveRow(this)"]').style.display = 'inline-block';
    }

    function saveRow(button) {
        var row = button.closest('tr');
        var editableCells = row.getElementsByClassName('editable');
        var id = row.querySelector('td').textContent;
        var nameField = document.getElementById('nameField');
        var latField = document.getElementById('latField');
        var lngField = document.getElementById('lngField');
        
        nameField.value = editableCells[0].value;
        latField.value = editableCells[1].value;
        lngField.value = editableCells[2].value;
        
        // Mettez à jour le champ caché du formulaire
        document.getElementById('idField').value = id;
        
        // Soumettez le formulaire
        document.getElementById('modificationForm').submit();
    }
    </script>
</body>
</html>
