<?php
session_start();
include 'fonctions.php';
//$_SESSION['id_user']=1;

$pdo=createConnextionBDD();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vote=(isset($_POST['downvote']))?-1:1;
    setVoteIdee($pdo,['id_user'=>$_SESSION['id_user'],'id_idee'=>$_POST['id_idee'],'vote'=>$vote]);
}
$tabIdees=getListIdees($pdo);
$tabRatioIdees=getCountVoteIdees($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Import librairies css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Seaweed+Script&display=swap" rel="stylesheet" />
    <title>Boite à idée</title>
</head>
<body>
    <?php
    require_once 'header.php';
    ?>
    <main>
        <div class="w-100 text-center p-4">
            <h1>Toutes les Idées</h1>
        </div>
        <section class="tableau-idees p-4">
            <?php
            foreach($tabIdees as $key=>$value){
                $tabDate=explode(' ',$value['created_at']);
                // echo '<pre>';
                // print_r($tabDate);
                // echo '</pre>';
                ?>
                <article class="border border-dark rounded rounded-pill shadow form-control">
                    <div class="col-lg-6">
                        <span class="col-lg-4"><strong><h3><?=strtoupper($value['titre_idees'])?></h3></strong></span>
                        <span class="col-lg-3"><?=$value['identifiant_user']?></span>
                        <span class="col-lg-3"><?=$tabDate[0]?></span><br><br>
                        <span class="col-lg-12">idée: <?=$value['text_idees']?></span><br>
                    </div>
                    <div class="col-lg-6"></div>
                        <form action="" method="POST">
                            <input type="text" name="id_idee" value="<?=$value['id_idees']?>" class="d-none">
                            <button type="submit" class="btn-submit" value="upvote" name="upvote">
                                <span class="material-icons">thumb_up</span>
                            <button type="submit" class="btn-submit" value="downvote" name="downvote">
                                <span class="material-icons">thumb_down</span>
                            </button>
                        </form>
                        <div>
                            <span class="material-icons">arrow_upward</span>
                            <?=$tabRatioIdees[$value['id_idees']]['upvote']??0?>
                            -
                            <?=$tabRatioIdees[$value['id_idees']]['downvote']??0?>
                            <span class="material-icons">arrow_downward</span>
                        </div>
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