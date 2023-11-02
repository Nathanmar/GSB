<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_villes_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
    <div class="admin-sidebar">
        <!-- Colonne de navigation -->
        <h2>Navigation</h2>
        <ul>
            <li><a href="admin.php">Accueil</a></li>
            <li><a href="map_admin.php">Map</a></li>
            <li><a href="villes_admin.php">Villes</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <!-- Contenu principal -->
        <h1>Page d'administration des villes</h1>

        <!-- Tableau pour afficher les données -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de connexion
                require_once('../includes/connexion.php');

                // Exécuter une requête SQL pour récupérer les données de la table "villes"
                $query = "SELECT * FROM villes";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $data = array();
                // Afficher les données dans le tableau
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                
                usort($data, function($a, $b) {
                    return $a['id'] - $b['id'];
                });
                
                // Afficher les données triées dans le tableau
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><input type='text' class='editable' value='" . $row['nom_ville'] . "' disabled></td>";
                    echo "<td><input type='text' class='editable' value='" . $row['nom_pays'] . "' disabled></td>";
                    echo "<td><input type='text' class='editable' value='" . $row['description'] . "' disabled></td>";
                    echo "<td><input type='text' class='editable' value='" . $row['image'] . "' disabled></td>";
                    echo "<td>";
                    echo "<form action='api/city_api.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='action' value='supprimer'>";
                    echo "<button type='submit'><i class='fa-solid fa-xmark'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='button' onclick='editRow(this)'><i class='fa-solid fa-pencil'></i></button>";
                    echo "<button type='button' onclick='saveRow(this)' style='display: none;'><i class='fa-solid fa-check'></i></button>";                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>    
        </table>
        <button class="add_city" id="addCityButton" onclick="addcity()">Ajouter une ville <i class='fa-solid fa-plus'></i></button>

        <!-- Formulaire pour ajouter une ville à la base de données -->
        <form  id="ajoutVilleForm" action="api/city_api.php" style="display:none;" method="POST">
        <input type="hidden" name="action" value="ajouter"> <!-- Action d'ajout -->
            <h2>Ajouter une nouvelle ville</h2>
            <label for="nouvelle_ville">Ville:</label>
            <input type="text" name="nouvelle_ville" id="nouvelle_ville" required>
            
            <label for="nouveau_pays">Pays:</label>
            <input type="text" name="nouveau_pays" id="nouveau_pays" required>
            
            <label for="nouvelle_description">Description:</label>
            <input name="nouvelle_description" id="nouvelle_description" required>
            
            <label for="nouvelle_image">Image:</label>
            <input type="text" name="nouvelle_image" id="nouvelle_image" required>
            
            <!-- Bouton pour soumettre le formulaire -->
            <button class="add_city" type="submit">Valider <i class='fa-solid fa-plus'></i></button>
        </form>

        <form id="modificationForm" action="api/city_api.php" method="POST" style="display: none;">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" id="idField" name="id" value="">
            <input type="hidden" id="nomVilleField" name="nouvelle_ville" value="">
            <input type="hidden" id="nomPaysField" name="nouveau_pays" value="">
            <input type="hidden" id="descriptionField" name="nouvelle_description" value="">
            <input type="hidden" id="imageField" name="nouvelle_image" value="">
        </form>
    </div>

    <script>
        function addcity() {
            var ajoutVilleForm = document.getElementById('ajoutVilleForm');
            if (ajoutVilleForm.style.display === 'none' || ajoutVilleForm.style.display === '') {
                ajoutVilleForm.style.display = 'block';
            } else {
                ajoutVilleForm.style.display = 'none';
            }
        }

        function toggleModificationForm(rowId) {
            var modificationForm = document.getElementById('modificationForm');
            var idField = document.getElementById('idField');
            var actionField = document.getElementById('actionField');

            modificationForm.style.display = 'block';
            idField.value = rowId;
            actionField.value = 'modifier';
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
            var nomVilleField = document.getElementById('nomVilleField');
            var nomPaysField = document.getElementById('nomPaysField');
            var descriptionField = document.getElementById('descriptionField');
            var imageField = document.getElementById('imageField');

            nomVilleField.value = editableCells[0].value;
            nomPaysField.value = editableCells[1].value;
            descriptionField.value = editableCells[2].value;
            imageField.value = editableCells[3].value;

            // Mettez à jour les champs cachés du formulaire
            document.getElementById('idField').value = id;

            // Soumettez le formulaire
            document.getElementById('modificationForm').submit();
}


    </script>
</body>
</html>
