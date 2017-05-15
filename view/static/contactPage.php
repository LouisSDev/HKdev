<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/contactPage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/googleMap.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/smoothScrolling.js"></script>


</head>
<body>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/modal.php");?>
<div class="content">
    <?php include_once($GLOBALS['root_dir'] . "/view/general/header.php");?>
    <div id="textMap">
        <div class="grid">
            <div class="column1">
                <div class="text">
                    <p>
                        Home Kepper
                    </p>
                    <p>
                        28, rue Notre-Dame des Champs
                    </p>
                    <p>
                        75006 Paris
                    </p>
                    <p>
                        01 41 22 67 44
                    </p>
                    <p>
                        contact@homekeeper.com
                    </p>
                </div>
            </div>
            <div class="column2">
                <div id="googleMap" style="width:80%;height:400px;"></div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfUVXK1gT4aQSnm4RZPoFHjc0MU-8U1vw&callback=myMap"></script>
            </div>
        </div>
        <div class="form_pointer">
            <a class="arrow_black scrolling" href="#contactForm">&raquo;</a>
        </div>
    </div>
    <div id="contactForm">
        <p class="textForm">
            Des questions ?
        </p>
        <div class="form contactForm">
            <form>
                <input type="text" name="field1" placeholder="Nom ">
                <input type="text" name="field2" placeholder="Prénom">
                <input type="email" name="field3" placeholder="Adresse mail">
                <input type="text" name="field4" placeholder="Sujet">
                <textarea class="message" name="field5" placeholder="Message"></textarea>
                <input class="button" type="submit" value="Envoyer" />
            </form>
        </div>
    </div>
</div>
</body>
</html>
