<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/csshomepage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js">></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/loader.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/smoothScrolling.js"></script>
</head>
<body>
<div class="loader">
    <h1>Please wait...</h1>
    <img src="<?php echo $GLOBALS['server_root']?>/ressources/img/gears.gif">
</div>
<div class="content">
    <?php include_once("header.php");?>
    <div class="container1"></div>
    <div class="container2">
        <a class="arrow scrolling" href="#presentation">&raquo;</a>
    </div>
    <div id="presentation">
        <img class="entreprise" src="<?php echo $GLOBALS['server_root']?>/ressources/img/entreprise.jpg"/>
        <p>
            Ces de ces deux constats qu’est né le projet HomeKeeper et c'est la raison pour laquelle nous mettons chaque jour toute notre énergie pour combattre ce fléau.
            HomeKeeper, c’est le meilleur de la domotique jusqu’à chez vous, à bas prix, avec un SAV et une maintenance de qualité, pour moins consommer et mieux respecter notre chère planète Terre.
            Non seulement vous réduirez votre consommation, mais vous améliorerez la sécurité et le confort de votre chez vous, tout en pouvant accéder aux données statistiques de la consommation de votre maison depuis n’importe quel appareil connecté (ordinateur, smartphone, tablette…).
            Home Keeper est simple, ergonomique, pratique, économique et écologique, alors qu’attendez-vous?
        </p>
    </div>
    <?php include_once("form.php");?>
</div>
</body>
</html>