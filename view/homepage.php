<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/homepage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/loader.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/smoothScrolling.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
</head>
<body>
<div class="black"></div>
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
        <div class="grid">
            <img class="entreprise" src="<?php echo $GLOBALS['server_root']?>/ressources/img/maison2.jpeg"/>
            <p>
                Chez Home Keeper nous imaginons un monde connecter et sécuriser permettant d’améliorer notre mode de vie.
                C’est pour atteindre cet idéal que nous travaillons chaque jour et que nous vous donnons la possibilité de profiter de notre savoir-faire et de nos innovations.
                Depuis l'an 1000 nous oeuvrons à améliorer votre habitat. Nous avons commencé par inventer la maison, puis la sérure, avant d'inventer les fenetres et nous sommes les précurseurs d'une économie nouvelle.
                Cette économie est nous l'avons appelée l'économie d'énerge.
            </p>
            <p>
                Avec une installation qui correspond à vos attentes et à votre habitat nous vous proposons aussi une maintenance efficace qui œuvre à ce que vous profitiez toujours des nouvelles technologies pour améliorer et sécuriser votre maison.
                Jamais les logiciel de Home Keeper n'ont été piraté et nos utilisateurs économise chaque jour près de 2 000 Kw d'énergie.
            </p>
            <p>
                Home Keeper c’est aussi une quête pour l’environnement. Une mission qui nous tient à cœur pour améliorer nos conditions de vie sur Terre.
                Choisissez Home Keeper pour Vous, choisissez Home Keeper pour Votre famille, choisissez Home Keeper pour votre Planète.
                Car ensemble nous pouvons changer le monde !
            </p>
        </div>
        <div class="form_pointer">
            <a class="arrow_black scrolling" href="#form">&raquo;</a>
        </div>
    </div>
    <div id="form">
        <div class="form_content">
            <h1>Vous êtes intéressé ?</h1>
            <h1>Demander un devis !</h1>
            <?php include_once("form.php");?>
        </div>
    </div>
</div>
</body>
</html>