<!DOCTYPE html>
<html>
<head>
    <title>Vérification de mot de passe</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Lier le fichier CSS externe -->
</head>
<body>
    <div class="container">
        <h1>Vérification du mot de passe</h1>
        
        <?php
        session_start(); // Démarrer la session pour stocker le mot de passe enregistré
        
        if (empty($_SESSION['motDePasseEnregistre']) && empty($_POST['motDePasse'])) {
            // Étape 1 : Demander à l'utilisateur de saisir et d'enregistrer le mot de passe
        ?>
            <form method="post">
                <label for="motDePasse">Choisissez un mot de passe (entre 6 et 10 caractères) :</label>
                <br>
                <input type="password" name="motDePasse" id="motDePasse" required pattern=".{6,10}">
                <br>
                <input type="submit" value="Enregistrer">
            </form>
        <?php
        } elseif (isset($_POST['motDePasse'])) {
            // Étape 2 : Vérifier la longueur du mot de passe avant de l'enregistrer
            $motDePasseEnregistre = $_POST['motDePasse'];

            if (strlen($motDePasseEnregistre) < 6 || strlen($motDePasseEnregistre) > 10) {
                echo "<p style='color: red;'>Erreur : Le mot de passe doit avoir entre 6 et 10 caractères. Réessayez.</p>";
                // Afficher à nouveau le premier formulaire
            ?>
                <form method="post">
                    <label for="motDePasse">Choisissez un mot de passe (entre 6 et 10 caractères) :</label>
                    <br>
                    <input type="password" name="motDePasse" id="motDePasse" required pattern=".{6,10}">
                    <br>
                    <input type="submit" value="Enregistrer">
                </form>
            <?php
            } else {
                // Le mot de passe a une longueur valide, enregistrez-le dans la session
                $_SESSION['motDePasseEnregistre'] = $motDePasseEnregistre;
                echo "Le mot de passe a été enregistré. Maintenant, veuillez le saisir à nouveau pour vérification.";
            }
        }
        ?>

        <br><br>

        <?php
        if (isset($_SESSION['motDePasseEnregistre'])) {
            if (empty($_POST['motDePasseValide'])) {
                // Étape 3 : Demander à l'utilisateur de saisir le mot de passe pour vérification
            ?>
                <form method="post">
                    <label for="motDePasseValide">Veuillez saisir le mot de passe pour vérification :</label>
                    <br>
                    <input type="password" name="motDePasseValide" id="motDePasseValide" required>
                    <br>
                    <input type="submit" value="Vérifier">
                </form>
            <?php
            } elseif (isset($_POST['motDePasseValide'])) {
                // Étape 4 : Vérifier si le mot de passe correspond au mot de passe enregistré
                $motDePasseSaisi = $_POST['motDePasseValide'];
                $motDePasseEnregistre = $_SESSION['motDePasseEnregistre'];

                // Inclure la fonction de validation
                include 'validation.php';

                $resultat = validerMotDePasse($motDePasseSaisi, $motDePasseEnregistre);
                echo "<p>$resultat</p>";
            }
        }
        ?>
    </div>
</body>
</html>
