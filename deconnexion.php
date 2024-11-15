<?php
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <span>Vous êtes maintenant déconnecté! </span><br>
    <button><a href="index.php">Retour à la connexion</a></button>
</body>
</html>