<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/contactPage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/googleMap.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/smoothScrolling.js"></script>
    <!--[if IE]><script>
        $(document).ready(function() {

            $("#form_wrap").addClass('hide');

        })

    </script><![endif]-->
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
        <?php
        $firstName = 'Hello!';
        if(isset($GLOBALS['view']['connected']) && $GLOBALS['view']['connected']) {

            /** @var User $user */
            $firstName = $GLOBALS['view']['user'] -> getFirstName();
        }
        ?>
        <div id="wrap">
            <div id='form_wrap'>
                <form>
                    <p><?php echo $firstName; ?></p>
                    <label for="email">Votre message : </label>
                    <textarea  name="message" value="Your Message" id="message" ></textarea>
                    <p>Best,</p>
                    <input type="text" name="lastName" value="" id="lastName" placeholder="Nom" />
                    <input type="text" name="firstName" value="" id="firstName" placeholder="Prénom" />
                    <input type="text" name="email" value="" id="email" placeholder="Adresse mail"/>
                    <input type="submit" name ="submit" value="Envoyer" />
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
