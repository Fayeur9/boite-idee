<?php
session_start();
require("fonctions.php");
$pdo = createConnextionBDD();
//Initialisation du message d'erreur
$errLog = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Récuperation des variables
    $login = trim(filter_input(INPUT_POST, "login", FILTER_SANITIZE_SPECIAL_CHARS));
    $mdp = trim(filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_SPECIAL_CHARS));
    //Vérification que les deux champs sont remplis
    if (empty($login) || empty($mdp)) {
        //Message d'erreur
        $errLog = "Le login ou le mot de passe est vide";
    } else {
        //Récuperation des infos de l'utilisateur
        $res = getUserInfoByLogin($pdo, $login);
        //Vérification que l'utilisateur existe dans la bdd et que le mot de passe correspond
        if ($res && password_verify($mdp, $res["password_user"])) {
            //Ajout des infos de l'utilisateur dans la session
            $_SESSION["id_user"] = $res["id_user"];
            $_SESSION["identifiant_user"] = $res["identifiant_user"];
            //Redirection vers la page de création
            header("Location: creation_idees.php");
        } else {
            //Message d'erreur
            $errLog = "Login ou mot de passe incorrect";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Boite à Idées</title>
</head>

<body>
    <main>
        <form method="POST">
            <h1>Formulaire de connexion :</h1>
            <p class="text-danger"><?= $errLog ?></p>
            <label for="login">Login :</label>
            <!-- Le value sert a remettre le login dans le champs pour éviter de le retapper -->
            <input type="text" class="form-control" name="login" value="<?= $_SERVER["REQUEST_METHOD"] == "POST" ? trim($_POST["login"]) : '' ?>">
            <br>
            <label for="mdp">Mot de passe :</label>
            <input type="password" class="form-control" name="mdp">
            <br>
            <input type="submit" class="btn btn-secondary" value="Se Connecter">
            <!-- Redirection vers la page de connexion -->
            <p>Vous n'avez pas encore de compte ? Inscrivez-vous <a href="inscription.php">Ici</a>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>