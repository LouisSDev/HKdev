<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $GLOBALS['view']['page_title']?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/mentions.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
        <?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
    </head>
    <body>
        <p>Société : Home Keeper</p>
        <p>Numéro de SIREN :</p><br/>
        <p>Raison social : Home Keeper</p><br/>
        <p>Forme juridique : Société commercial</p><br/>
        <p>Nom : Arnal</p><br/>
        <p>Prénom : Adrien </p><br/>
        <p>Adress : 28 rue notre Dame des Champs 75006 Paris</p><br/>
        <p>Numéro : 06 06 06 06 06</p><br/>
        <p>Adresse de courier électronique : home.keeper@home.keeper.fr</p><br/>
        <p>Téléphone de l'hébergeur : 06 07 07 07 07</p><br/>
        <form>
            <input type="hidden" name="submittedform" value="MENTION_LEGAL">
            <p>Nos cookies:
                <br>
                Nous permettent d'améliorer votre expérience sur notre site.
                <input type="submit" type="submit" value="J'accepte"><input type="submit" type="submit" value="Je refuse">
            </p>
            <input type="hidden" name="submittedform" value="MENTION_LEGAL">
        </form>
    </body>
</html>
