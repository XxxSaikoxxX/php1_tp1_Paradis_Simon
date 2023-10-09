<!DOCTYPE html>
<html>
<head>
    <title>Vérification de mot de passe</title>
</head>
<body>
    <h1>Vérification du mot de passe</h1>
    <form method="post">
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" id="motDePasse" required>
        <br>
        <input type="submit" value="Vérifier">
    </form>

    <?php
    // Inclure la fonction de validation
    include 'validation.php';

    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $motDePasseUser = $_POST['motDePasse'];
        $validation = validerMotDePasse($motDePasseUser);
        echo "<p>$validation</p>";
    }
    ?>

</body>
</html>
