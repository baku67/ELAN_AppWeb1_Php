<?php
    // ProductCount:
    require "functions.php";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Web 1</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>

    <body> 

        <h1><?= $title ?></h1><br>
        <nav>
            <ul id="navList">
                <li class='<?= $onglet1 ?>'><a href='index.php'>Accueil</a></li>
                <li class='<?= $onglet2 ?>'><a href='recap.php'>Panier</a><span id="nbrOfProducts"><?= $total ?></span></li>
            </ul>
        </nav>

        <?= $content ?>

        <br><br>

        <?= $msg ?>


    </body>
</html>