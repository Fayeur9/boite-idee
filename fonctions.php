<?php
function createConnextionBDD(){
    // Variables de connexion
    $domaine = 'localhost'; // Domaine ou adresse IP du serveur
    $table = 'projet_base_php'; // Nom de la base de données
    $user = 'root'; // Nom d'utilisateur de la base de données
    $password = ''; // Mot de passe de la base de données

    try {
        // Création de l'objet PDO
        $pdo = new PDO("mysql:host=$domaine;dbname=$table;charset=utf8", $user, $password);

        // Configuration des options PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer les exceptions
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération par défaut

        echo "Connexion réussie à la base de données '$table'.";
        return $pdo;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion
        echo "Erreur de connexion : " . $e->getMessage();
    }
}
