<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $GLOBALS['view']['page_title']?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/static/disclaimer.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
        <?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
        <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    </head>
    <body>
    <div class="hk-centered-block">
        <div class="hk-block">
            <p class="hk-text">Société : Home Keeper<br/>
                Numéro de SIREN : 8888 888 88 88888<br/>
                Raison social : Home Keeper<br/>
                Forme juridique : Société commercial<br/>
                Nom : Arnal<br/>
                Prénom : Adrien <br/>
                Adresse : 28 rue notre Dame des Champs 75006 Paris<br/>
                Numéro : 06 06 06 06 06<br/>
                Adresse de courier électronique : home.keeper@home.keeper.fr
            </p><br/>
            <p class="hk-text">Téléphone de l'hébergeur : 06 07 07 07 07<br/>
                Adresse de l'hébergeur : 28 rue notre Dame des Champs 75006 Paris
            </p>
            <form>
                <p class="hk-text">Nos cookies:
                    <br>
                    Nous permettent d'améliorer votre expérience sur notre site.
                    <input type="submit" name="submittedform" value="J'accepte"><input type="submit" name="submittedform" value="Je refuse">
                </p>
            </form>
        </div>
    </div>

    <?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
    </body>
</html>
