<?php
session_start();
include 'fonctions.php';
$_SESSION['id_user']=1;

$pdo=createConnextionBDD();
$tabRatioIdees=getCountVoteIdees($pdo);
$tabIdees=getListIdeesByUser($pdo,['id_user'=>$_SESSION['id_user']]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    $vote=(isset($_POST['downvote']))?-1:1;
    editIdee($pdo,['id_user'=>$_SESSION['id_user'],'id_idee'=>$_POST['id_idee'],'vote'=>$vote]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Seaweed+Script&display=swap" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    <?php
    require_once 'header.php';
    ?>
    <main>
        <section class="tableau-idees p-4">
            <?php
            foreach($tabIdees as $key=>$value){
                ?>
                <article class="border border-danger">
                    <span class="col-lg-6">nom:<?=$value['identifiant_user']?></span>
                    <span class="col-lg-6">date de création:<?=$value['created_at']?></span><br>
                    <span class="col-lg-12">idee:<?=$value['text_idees']?></span><br>
                    <form action="creation_idees.php" method="POST">
                        <input type="text" name="id_idee" value="<?=$value['id_idees']?>" class="d-none">
                        <input type="text" name="titre_idees" value="<?=$value['titre_idees']?>" class="d-none">
                        <input type="text" name="text_idees" value="<?=$value['text_idees']?>" class="d-none">
                        <button type="submit" class="btn-submit btn">
                            <span class="material-icons">edit</span>
                        </button>
                    </form>
                    <div>
                        <span class="material-icons">arrow_upward</span>
                        <?=$tabRatioIdees[$value['id_idees']]['upvote']?>
                        -
                        <?=$tabRatioIdees[$value['id_idees']]['downvote']?>
                        <span class="material-icons">arrow_downward</span>
                    </div>
                </article>
                <br>
                <?php
            }
            ?>
        </section>
    </main>
</body>
</html>