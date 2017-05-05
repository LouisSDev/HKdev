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
            <form>
                <fieldset>
                    <input type="email" name="mail" placeholder="Adresse mail">
                    <input type="password" name="password" placeholder="Mot de passe">
                </fieldset>
                <input class="button" type="submit" value="Envoyer" />
            </form>
            <div class="link">
                <a href="<?php echo $GLOBALS['server_root']?>\lol" target="_self">Mot de passe oublié ?a</a>
            </div>
        </div>

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
        <?php
        if(!empty($GLOBALS['view']['registration'])){
            ?>
            <p id="successful-registration">
                Votre devis a bien été déposé, vous serez bientôt contacté par notre équipe!
            </p>
            <?php
        }
        else{

            if(!empty($GLOBALS['view']['error'])){
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
                        <form>
                            <fieldset>
                                <div class="col1">
                                    <input type="text" name="firstName" placeholder="Nom ">
                                    <input type="text" name="lastName" placeholder="Prénom">
                                    <input type="text" name="country" placeholder="Pays"/>
                                    <input type="text" name="city" placeholder="Ville"/>
                                </div>
                                <div class="col2">
                                    <input type="text" name="address" placeholder="Adresse"/>
                                    <input type="text" name="mail" placeholder="Adresse mail"/>
                                    <input type="text" name="cellPhoneNumber" placeholder="Numéro de téléphone">
                                    <input type="password" name="password" placeholder="Mot de passe"/>
                                    <input type="password" name="passwordRepeat" placeholder="Répétez votre mot de passe"/>
                                </div>

                            </fieldset>
                            <input type="file" name="file" />
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