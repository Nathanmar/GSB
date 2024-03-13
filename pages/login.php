<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Connexion - GSB</title>
</head>
<body>
    <header>
        <img src="../assets/pictures/logo.jpg" alt="Logo" class="logo">
        <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
        <nav id="nav-bar">
            <ul class="menu">
                <li class="nav-link"><a href="index.php">Accueil</a></li>
                <li class="nav-link"><a href="villes">Partenaires</a></li>
                <li class="nav-link"><a href="map">Map</a></li>
                <li class="nav-link"><a href="info">Paramètres</a></li>
                <li class="nav-link"><a href="contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="login-form">
            <h2>Connexion</h2>
            <form action="../includes/process_login.php" method="POST">
                <div class="form-group">
                    <label for="pseudo">Adresse email :</label>
                    <input type="email" id="pseudo" name="pseudo" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                <div class="form-group">
                    <button type="submit">Se connecter</button>
                </div>
                <div class="form-group stay-connected">
                    <input type="checkbox" id="rester_connecte" name="rester_connecte">
                    <label for="rester_connecte">Rester connecté</label>
                </div>
            </form>
        </div>

        <div>
            <a class="change-btn" onclick="window.location.href='signup.php'">Créer un compte</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>
</body>
</html>
