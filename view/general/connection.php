<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
</head>
<body>
<?php include_once($GLOBALS['root_dir'] . '/view/general/error.php') ?>
    <div class="container">
        <form action="<?php echo $GLOBALS['server_root'] . '/user/dashboard'?>" method="post" >
            <input class="box" type="text" required="" placeholder="Nom d'utilisateur" name="userMail"><br/>
            <input class="box" type="password" required="" placeholder="Mot de passe" name="userPassword"><br/>
            <input class="box" type="checkbox">Se souvenir de moi ?<br/>
            <input class="btn" type="submit" name="Envoyer">
        </form>
            <div class="link">
                <a href="<?php echo $GLOBALS['server_root']?>\lol" target="_self">Mot de passe oublié ?</a>
            </div>
    </div>
</body>
</html>