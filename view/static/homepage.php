<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/homepage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
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
    <div id="modal">
        <i class="fa fa-times-circle fa-lg close" aria-hidden="true"></i>
        <div class="form">
            <form method="post" action="<?php echo $GLOBALS['server_root'] . '/connect'?>">
                    <input type="email" name="mail" placeholder="Adresse mail">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input class="button" type="submit" value="Envoyer" />
            </form>
            <div class="link">
                <a href="<?php echo $GLOBALS['server_root']?>\lol" target="_self">Mot de passe oublié ?</a>
            </div>
        </div>

    </div>
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
            <div class="form_pointer">
                <a class="arrow_black scrolling" href="#form">&raquo;</a>
            </div>
        </div>
        <?php
        if(isset($GLOBALS['view']['registration'])){
            ?>
            <p id="successful-registration">
                Votre devis a bien été déposé, vous serez bientôt contacté par notre équipe!
            </p>
            <?php
        }
        else{

            if(isset($GLOBALS['view']['error'])){
                ?>
                <p id="registration-error">
                    <?php
                    echo $GLOBALS['view']['error'];
                    ?>
                </p>
                <?php
            }
            ?>
            <div id="form">
                <div class="form_content">
                    <h1>Vous êtes intéressé ?</h1>
                    <h1>Demander un devis !</h1>
                    <div class="form">
                        <form method="post" enctype="multipart/form-data">
                            <div class="rows">
                                <div class="col1">
                                    <input type="text" name="firstName" placeholder="Nom" required/>
                                    <input type="text" name="lastName" placeholder="Prénom" required/>
                                    <input type="text" name="country" placeholder="Pays" required/>
                                    <input type="text" name="city" placeholder="Ville" required/>
                                    <input type="text" name="address" placeholder="Adresse" required/>
                                </div>
                                <div class="col2">
                                    <input type="email" name="mail" placeholder="Adresse mail" required/>
                                    <input type="text" name="cellPhoneNumber" placeholder="Numéro de téléphone" required/>
                                    <input type="password" name="password" placeholder="Mot de passe" required/>
                                    <input type="password" name="passwordRepeat" placeholder="Répétez votre mot de passe" required/>
                                </div>
                            </div>
                            <input type="file" name="quote" />
                            <input class="button" type="submit" value="Envoyer" />
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>