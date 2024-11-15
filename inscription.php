<?php
require("fonctions.php");
$pdo = createConnextionBDD();

$errLog = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim(filter_input(INPUT_POST, "login", FILTER_SANITIZE_SPECIAL_CHARS));
    $mdp = password_hash(trim(filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_SPECIAL_CHARS)), PASSWORD_BCRYPT);
    //Verification de l'existance du login
    $sql = "SELECT identifiant_user FROM user WHERE identifiant_user = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($res)) {
        //Ajout de l'utilisateur
        $sql = "INSERT INTO `user` (`identifiant_user`, `password_user`) VALUES ( :login , :mdp );";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } else {
        $errLog = "Ce nom d'utilisateur est déja pris";
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
            <h1>Formulaire d'inscription :</h1>
            <p class="text-danger"><?= $errLog ?></p>
            <label for="login">Login :</label>
            <input type="text" class="form-control" name="login" value="<?= $_SERVER["REQUEST_METHOD"] == "POST" ? trim($_POST["login"]) : '' ?>">
            <br>
            <label for="mdp">Mot de passe :</label>
            <input type="password" class="form-control" name="mdp">
            <br>
            <input type="submit" class="btn btn-secondary" value="S'Inscrire">
            <p>Vous avez déjà un compte ? Connectez-vous <a href="index.php">Ici</a>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>