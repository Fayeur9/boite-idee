<?php
session_start();
include 'fonctions.php';
//$_SESSION['id_user']=1;

var_dump($_SESSION['id_user']);

$pdo=createConnextionBDD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    $vote=(isset($_POST['downvote']))?-1:1;
    editIdee($pdo,['id_user'=>$_SESSION['id_user'],'id_idees'=>$_POST['id_idees'],'vote'=>$vote]);
}
$tabRatioIdees=getCountVoteIdees($pdo);
$tabIdees=getListIdeesByUser($pdo,['id_user'=>$_SESSION['id_user']]);

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
        <div class="w-100 text-center p-4">
            <h1>Mes Idées</h1>
        </div>
        <section class="p-4">
            <?php
            foreach($tabIdees as $key=>$value){
                $tabDate=explode(' ',$value['created_at']);
                ?>
                <article class="border border-dark shadow-lg p-3 mb-5 bg-body-tertiary rounded form-control">
                    <div class="col-lg-6">
                        <span class="col-lg-4"><strong><h3><?=strtoupper($value['titre_idees'])?></h3></strong></span>
                        <span class="col-lg-3"><?=$value['identifiant_user']?></span>
                        <span class="col-lg-3"><?=$tabDate[0]?></span><br><br>
                        <span class="col-lg-12">idée: <?=$value['text_idees']?></span><br>
                    </div>
                    <div class="col-lg-6">
                        <form action="creation_idees.php" method="POST">
                            <input type="text" name="id_idees" value="<?=$value['id_idees']?>" class="d-none">
                            <input type="text" name="titre_idees" value="<?=$value['titre_idees']?>" class="d-none">
                            <input type="text" name="text_idees" value="<?=$value['text_idees']?>" class="d-none">
                            <div>
                                <button type="submit" class="btn">
                                    <span class="material-icons">edit</span>
                                </button>
                                <span class="material-icons">arrow_upward</span>
                                <?=$tabRatioIdees[$value['id_idees']]['upvote']??0?>
                                -
                                <?=$tabRatioIdees[$value['id_idees']]['downvote']??0?>
                                <span class="material-icons">arrow_downward</span>
                            </div>
                        </form>
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