<?php
session_start();

require("fonctions.php");
$pdo = createConnextionBDD();
$msgIdee = ["", ""];
$titre = "Création d'Idée :";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre_idees = trim(filter_input(INPUT_POST, "titre_idees", FILTER_SANITIZE_SPECIAL_CHARS));
    $text_idees = trim(filter_input(INPUT_POST, "text_idees", FILTER_SANITIZE_SPECIAL_CHARS));
    $id_idees = filter_input(INPUT_POST, "id_idees", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($titre_idees) || empty($text_idees)) {
        $msgIdee = ["text-danger", "Vous ne pouvez pas créer d'idée en mettant un titre ou un text vide"];
    } else {
        $date = date('Y-m-d H:i:s', time());
        if ($id_idees != null) {
            $sql = "UPDATE `idees` SET `titre_idees`= :titre_idees,`text_idees`= :text_idees, `updated_at`= :updated_at WHERE `id_idees` = :id_idees";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':titre_idees', $titre_idees, PDO::PARAM_STR);
            $stmt->bindParam(':text_idees', $text_idees, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $date, PDO::PARAM_STR);
        } else {
            $sql = "INSERT INTO `idees`(`titre_idees`, `text_idees`, `created_by`, `created_at`, `updated_at`) VALUES (:titre_idees, :text_idees, :created_by, :created_at, :updated_at)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':titre_idees', $titre_idees, PDO::PARAM_STR);
            $stmt->bindParam(':text_idees', $text_idees, PDO::PARAM_STR);
            $stmt->bindParam(':created_by', $_SESSION["id_user"], PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $date, PDO::PARAM_STR);
            $stmt->execute();

            $msgIdee = ["text-success", "Idée créée avec succès"];
        }
        $_POST["titre_idees"] = "";
        $_POST["text_idees"] = "";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Boite à Idées</title>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <main>
        <form method="POST">
            <h1>Création d'Idée :</h1>
            <p class="<?= $msgIdee[0] ?>"><?= $msgIdee[1] ?></p>
            <label for="titre_idees">Titre de l'idée :</label>
            <input type="text" class="form-control" name="titre_idees" value="<?= $_SERVER["REQUEST_METHOD"] == "POST" ? trim($_POST["titre_idees"]) : '' ?>">
            <label for="text_idees">Votre idée :</label>
            <textarea rows="10" class="form-control" name="text_idees" maxlength="500"><?= $_SERVER["REQUEST_METHOD"] == "POST" ? trim($_POST["text_idees"]) : '' ?></textarea>
            <br>
            <input type="submit" class="btn btn-secondary" value="Créer">
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>