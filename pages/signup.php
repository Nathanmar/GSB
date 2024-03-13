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
            <h2>Créer un compte</h2>
            <form action="../includes/process_signup.php" method="POST" onsubmit="return checkPasswords()">
                <div class="form-group">
                    <label for="nouveau_pseudo">Nom d'utilisateur :</label>
                    <input type="text" id="nouveau_pseudo" name="nouveau_pseudo" required autocomplete="off">
                </div>
                <div class="form-group">
                <label for="nouveau_mot_de_passe">Mot de passe :</label>
                <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required>
            </div>

            <div class="form-group">
                <label for="confirmer_mot_de_passe">Confirmer le mot de passe :</label>
                <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" required>
            </div>

                <div class="form-group">
                    <button type="submit">S'inscrire</button>
                </div>
            </form>
        </div>

        <div>
            <a class="change-btn" onclick="window.location.href='login.php'">Se connecter</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 GSB. Tous droits réservés.</p>
    </footer>

    <script>
    function checkPasswords() {
        var password1 = document.getElementById('nouveau_mot_de_passe').value;
        var password2 = document.getElementById('confirmer_mot_de_passe').value;

        if (password1 !== password2) {
            alert("Les mots de passe ne correspondent pas. Veuillez les saisir à nouveau.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>
