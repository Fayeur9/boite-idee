<?php
session_start();
require("fonctions.php");
$pdo = createConnextionBDD();
//Initialisation du message d'erreur
$msgIdee = ["", ""];
//Initialisation des textes
$text = ["Création", "Créer"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Récuperation des variables
    $titre_idees = trim(filter_input(INPUT_POST, "titre_idees", FILTER_SANITIZE_SPECIAL_CHARS));
    $text_idees = trim(filter_input(INPUT_POST, "text_idees", FILTER_SANITIZE_SPECIAL_CHARS));
    $id_idees = filter_input(INPUT_POST, "id_idees", FILTER_SANITIZE_SPECIAL_CHARS);
    //Changement des textes si c'est une modification en vérifiant si un id d'idée est dans le POST
    if ($id_idees != null) {
        $text = ["Modification", "Modifier"];
    }
    //Vérifie si le texte ou le titre est vide
    if (empty($titre_idees) || empty($text_idees)) {
        //Message d'erreur
        $msgIdee = ["text-danger", "Vous ne pouvez pas créer d'idée en mettant un titre ou un text vide"];
    } else {
        //Vérifie si l'id d'idée n'est pas null et si on a soumis le formulaire
        if ($id_idees != null && isset($_POST['submit'])) {
            //Modification de l'idée
            updateIdee($pdo, $titre_idees, $text_idees, $id_idees);
            //Changement du message pour indiqué la modification et vidage des champs
            $msgIdee = ["text-success", "Idée modifiée avec succès"];
            $_POST["titre_idees"] = "";
            $_POST["text_idees"] = "";
        }
        //Si l'id d'idée n'a pas de valeur dans POST alors c'est une création, on regarde si on a soumis le formulaire
        elseif (isset($_POST['submit'])) {
            //Création de l'idée
            insertIdee($pdo, $titre_idees, $text_idees);
            //Changement du message pour indiqué la création et vidage des champs
            $msgIdee = ["text-success", "Idée créée avec succès"];
            $_POST["titre_idees"] = "";
            $_POST["text_idees"] = "";
        }
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
            <h1><?= $text[0] ?> d'Idée :</h1>
            <!-- Affichage des messages lié au erreurs et au actions -->
            <p class="<?= $msgIdee[0] ?>"><?= $msgIdee[1] ?></p>
            <label for="titre_idees">Titre de l'idée :</label>
            <!-- Le value sert a remettre le titre dans le champs pour éviter de le retapper -->
            <input type="text" class="form-control" name="titre_idees" value="<?= $_SERVER["REQUEST_METHOD"] == "POST" ? trim($_POST["titre_idees"]) : '' ?>">
            <label for="text_idees">Votre idée :</label>
            <!-- Le value sert a remettre le texte dans le champs pour éviter de le retapper -->
            <textarea rows="10" class="form-control" name="text_idees" maxlength="500"><?= $_SERVER["REQUEST_METHOD"] == "POST" ? trim($_POST["text_idees"]) : '' ?></textarea>
            <br>
            <!-- Affichage du texte du bouton selon si c'est modification ou une création -->
            <button type="submit" name="submit" value="clicked" class="btn btn-secondary"><?= $text[1] ?></button>
            <!-- Input en hiddin pour repasser l'id de l'idée après que le formulaire soit submit en cas de modification -->
            <input type="hidden" name="id_idees" value="<?= isset($_POST["id_idees"]) ? $_POST["id_idees"] : '' ?>">
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>