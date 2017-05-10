<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/contactPage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/googleMap.js"></script>


</head>
<body>
    <?php include_once(__DIR__ . "/general/header.php");?>
<div class="address">
    <p>
        Home Kepper
    </p>
    <p>
        28, rue Notre-Dame des Champs
    </p>
    <p>
        75006 Paris
    </p>
</div>
<div id="googleMap" style="width:100%;height:400px;"></div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfUVXK1gT4aQSnm4RZPoFHjc0MU-8U1vw&callback=myMap"></script>

<div class="form">
    <form>
        <fieldset>
            <input type="text" name="field1" placeholder="Nom ">
            <input type="text" name="field2" placeholder="Prénom">
            <input type="email" name="field3" placeholder="Adresse mail">
            <input type="text" name="field4" placeholder="Sujet">
            <textarea class="message" name="field5" placeholder="Message"></textarea>
        </fieldset>
        <input class="button" type="submit" value="Envoyer" />
    </form>
</div>
</body>
</html>
