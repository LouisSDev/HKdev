<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/static/contactPage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <!--[if IE]><script>
        $(document).ready(function() {
            $("#form_wrap").addClass('hide');

        })

    </script><![endif]-->
</head>
<body>
<?php
    include_once ($GLOBALS['root_dir'] . "/view/general/modal.php");
 ?>
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
                <iframe width="80%" height="400px" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ06_UP85x5kcRgBMNU5o4Kbc&key=AIzaSyAEFj7HYS5wGN49cLS1ei0miY6_kuCuuPs" allowfullscreen>

                </iframe>
            </div>
        </div>
        <div class="form_pointer">
            <a class="arrow_black scrolling" href="#contactForm">&raquo;</a>
        </div>
    </div>
    <?php
        include_once($GLOBALS['root_dir'] . '/view/general/error.php');
    ?>
    <div id="contactForm">
        <p class="textForm">
            Des questions ?
        </p>
        <?php
        $firstName = 'Hello!';
        if(isset($GLOBALS['view']['connected']) && $GLOBALS['view']['connected']) {
            $firstName = $GLOBALS['view']['user'] -> getFirstName();
        }
        ?>
        <div id="wrap">
            <div id='form_wrap'>
                <form method="POST" action="<?php echo $GLOBALS['server_root'] ?>/contact">
                    <p><?php echo $firstName; ?></p>
                    <label for="email">Votre message : </label>
                    <textarea  name="message" value="Your Message" id="message" ></textarea>
                    <p>Best,</p>
                    <?php if(!$GLOBALS['view']['user']) { ?>
                        <input type="text" name="lastName" value="" id="lastName" placeholder="Nom"/>
                        <input type="text" name="firstName" value="" id="firstName" placeholder="Prénom"/>
                        <input type="text" name="email" value="" id="email" placeholder="Adresse mail"/>
                        <?php
                    }
                    ?>

                    <input type="submit" name ="submit" value="Envoyer" />
                </form>
            </div>
        </div>
    </div>

    <?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
</div>
</body>
</html>
