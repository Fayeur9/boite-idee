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

        // echo "Connexion réussie à la base de données '$table'.";
        return $pdo;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion
        echo "Erreur de connexion : " . $e->getMessage();
    }
}
/* --- Baptiste --- */

function getListIdees($pdo){
    $requete="
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
        ORDER BY i.created_at ASC
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getListIdeesByUser($pdo, $pParametres){
    $requete="
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
        ORDER BY i.created_at ASC
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->execute([
        ":id_user"=>$pParametres['id_user'],
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getCountVoteIdees($pdo){
    $requete='
    SELECT
        id_idees,
        SUM(CASE WHEN vote = 1 THEN 1 ELSE 0 END) AS upvote,
        SUM(CASE WHEN vote = -1 THEN 1 ELSE 0 END) AS downvote
    FROM vote_idees
    GROUP BY id_idees;
';
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $formattedResult = [];
    foreach ($result as $row) {
        $formattedResult[$row['id_idees']] = [
            'upvote' => $row['upvote'],
            'downvote' => $row['downvote'],
        ];
    }
    return $formattedResult;
}
function setVoteIdee($pdo, $pParametres){
    $requete='
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
        ":id_user"=>$pParametres['id_user'],
        ":id_idee"=>$pParametres['id_idee'],
        ":vote"=>$pParametres['vote'],
        ":date"=>date('Y-m-d H:i:s', time())
    ]);
}
function editIdee($pdo, $pParametres){
    $requete="
        UPDATE idees
        SET text_idees = ':text_idees'
        WHERE id_idees = :id_idees;
    ";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([
        ":id_idees"=>$pParametres['id_idees'],
        ":text_idees"=>$pParametres['text_idees']
    ]);
}