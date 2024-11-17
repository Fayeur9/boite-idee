<?php
function createConnextionBDD()
{
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
        return $pdo;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion
        echo "Erreur de connexion : " . $e->getMessage();
    }
}
/* --- Baptiste --- */
// Fonction permettant de récupérer un tableau avec toutes les idées dans la bdd ainsi que les infos de son éditeur
function getListIdees($pdo)
{
    $requete = "
        SELECT
            i.id_idees,
            i.text_idees,
            i.titre_idees,
            i.created_at,
            u.identifiant_user,
            u.id_user
        FROM
            idees AS i INNER JOIN
            user AS u
        WHERE
            i.created_by=u.id_user
        ORDER BY i.created_at DESC
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//fonction permettant de récupérer toutes les idées de l'utilisateur de la session dans un tableau
function getListIdeesByUser($pdo, $pParametres)
{
    $requete = "
        SELECT
            i.id_idees,
            i.text_idees,
            i.titre_idees,
            i.created_at,
            u.identifiant_user,
            u.id_user
        FROM
            idees AS i INNER JOIN
            user AS u
        WHERE
            i.created_by=u.id_user AND
            u.id_user=:id_user
        ORDER BY i.created_at DESC
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->execute([
        ":id_user" => $pParametres['id_user'],
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//fonction permettant de récupérer un tableau avec 
function getCountVoteIdees($pdo)
{
    $requete = '
    SELECT
        id_idees,
        SUM(CASE WHEN vote = 1 THEN 1 ELSE 0 END) AS upvote,
        SUM(CASE WHEN vote = -1 THEN 1 ELSE 0 END) AS downvote
    FROM vote_idees
    GROUP BY id_idees;
';
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $formattedResult = [];
    // Met l'id de l'idée en clé du tableau pour pouvoir les retrouver dans les boucles plus tard
    foreach ($result as $row) {
        $formattedResult[$row['id_idees']] = [
            'upvote' => $row['upvote'],
            'downvote' => $row['downvote'],
        ];
    }
    return $formattedResult;
}

// Fonction permettant de créer un modifier le vite de l'utilisateur pour une idée
function setVoteIdee($pdo, $pParametres)
{
    $requete = '
        INSERT INTO vote_idees
        (
            id_user,
            id_idees,
            vote,
            date_vote
        )
        VALUES (
            :id_user,
            :id_idee,
            :vote,
            :date
        )
        ON DUPLICATE KEY UPDATE
            vote = VALUES(vote),
            date_vote = VALUES(date_vote)
    ';
    $stmt = $pdo->prepare($requete);
    $stmt->execute([
        ":id_user" => $pParametres['id_user'],
        ":id_idee" => $pParametres['id_idee'],
        ":vote" => $pParametres['vote'],
        ":date" => date('Y-m-d H:i:s', time())
    ]);
}

/* --- Lenny --- */

//Fonction qui retourne les informations d'un user à partir de son login
function getUserInfoByLogin($pdo, $login)
{
    $sql = "SELECT * FROM user WHERE identifiant_user = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Fonction qui insert un nouveau User dans la bdd
function insertUser($pdo, $login, $mdp)
{
    $sql = "INSERT INTO `user` (`identifiant_user`, `password_user`) VALUES ( :login , :mdp );";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $stmt->execute();
}

//Fonction qui met a jour une idée dans la bdd
function updateIdee($pdo, $titre_idees, $text_idees, $id_idees)
{
    $date = date('Y-m-d H:i:s', time());
    $sql = "UPDATE `idees` SET `titre_idees`= :titre_idees,`text_idees`= :text_idees, `updated_at`= :updated_at WHERE `id_idees` = :id_idees";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre_idees', $titre_idees, PDO::PARAM_STR);
    $stmt->bindParam(':text_idees', $text_idees, PDO::PARAM_STR);
    $stmt->bindParam(':updated_at', $date, PDO::PARAM_STR);
    $stmt->bindParam(':id_idees', $id_idees, PDO::PARAM_STR);
    $stmt->execute();
}

//Fonction qui insert une idée dans la bdd
function insertIdee($pdo, $titre_idees, $text_idees)
{
    $date = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO `idees`(`titre_idees`, `text_idees`, `created_by`, `created_at`, `updated_at`) VALUES (:titre_idees, :text_idees, :created_by, :created_at, :updated_at)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre_idees', $titre_idees, PDO::PARAM_STR);
    $stmt->bindParam(':text_idees', $text_idees, PDO::PARAM_STR);
    $stmt->bindParam(':created_by', $_SESSION["id_user"], PDO::PARAM_INT);
    $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
    $stmt->bindParam(':updated_at', $date, PDO::PARAM_STR);
    $stmt->execute();
}
