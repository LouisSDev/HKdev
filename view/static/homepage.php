<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/static/homepage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/loader.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/smoothScrolling.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
</head>
<body>
    <div class="loader">
        <h1>Please wait...</h1>
        <img src="<?php echo $GLOBALS['server_root']?>/ressources/img/gears.gif">
    </div>
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/modal.php")?>
    <div class="content">
        <?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
        <div class="container1"></div>
        <div class="container2">
            <a class="arrow scrolling" href="#presentation">&raquo;</a>
        </div>
        <div id="presentation">
            <div class="grid">
                <div class="column1">
                    <p>CONNECTE</p>
                    <i class="fa fa-wifi fa-5x" aria-hidden="true"></i>
                    <p class="description">Profitez d'un système entièrement connecté qui vous permettra d'effectuer des économies sur vos factures</p>
                </div>
                <div class="column2">
                    <p>INTELLIGENT</p>
                    <i class="fa fa-home fa-5x" aria-hidden="true"></i>
                    <p class="description">Le système que nous proposons est entièrement intelligent et simple d'utilisation pour contrôler les paramètres de votre maison</p>
                </div>
                <div class="column3">
                    <p>SUIVI</p>
                    <i class="fa fa-line-chart fa-5x" aria-hidden="true"></i>
                    <p class="description">Grâce à notre système amélioré, vous pouvez visualiser intégralement votre consommation</p>
                </div>
            </div>
         <?php   if(!isset($GLOBALS['view']['connected']) || !$GLOBALS['view']['connected']) { ?>
            <div class="form_pointer">
                <a class="arrow_black scrolling" href="#form">&raquo;</a>
            </div>
        </div>
        <?php
            if (isset($GLOBALS['view']['registration'])) {
                ?>
                <p id="successful-registration">
                    Votre devis a bien été déposé, vous serez bientôt contacté par notre équipe!
                </p>
                <?php
            } else {
                include_once($GLOBALS['root_dir'] . '/view/general/error.php'); ?>
                <div id="form">
                    <div class="form_content">
                        <h1>Vous êtes intéressé ?</h1>
                        <h1>Demander un devis !</h1>
                        <div class="hk-form hk-form-centered">
                            <form method="post" enctype="multipart/form-data">
                                <div class="hk-rows">
                                    <div class="hk-col1">
                                        <input type="text" name="firstName" placeholder="Nom" required/>
                                        <input type="text" name="lastName" placeholder="Prénom" required/>
                                        <input type="text" name="country" placeholder="Pays" required/>
                                        <input type="text" name="city" placeholder="Ville" required/>
                                        <input type="text" name="address" placeholder="Adresse" required/>
                                    </div>
                                    <div class="hk-col2">
                                        <input type="email" name="mail" placeholder="Adresse mail" required/>
                                        <input type="text" name="cellPhoneNumber" placeholder="Numéro de téléphone"
                                               required/>
                                        <input type="password" name="password" placeholder="Mot de passe" required/>
                                        <input type="password" name="passwordRepeat"
                                               placeholder="Répétez votre mot de passe" required/>
                                    </div>
                                </div>
                                <input id="upload-quote" type="file" name="quote"/>
                                <input class="button" type="submit" value="Envoyer"/>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
             echo '</div>';
        }
        ?>
        <?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
    </div>

</body>

</html>