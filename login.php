<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Connexion - UrbanVenture</title>
</head>
<body>
    <header>
        <img src="pictures/logo.png" alt="Logo" class="logo">
        <nav>
            <!-- Vos liens de navigation ici -->
        </nav>
    </header>

    <main>
        <div class="login-form">
            <h2>Connexion</h2>
            <form action="process_login.php" method="POST">
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                </div>
                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                <div class="form-group">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 UrbanVenture. Tous droits réservés.</p>
    </footer>
</body>
</html>
