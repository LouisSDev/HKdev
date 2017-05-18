<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>\ressources\css\global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>\ressources\css\error404.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
    <div class="notFound">
        <img class="oups" src="<?php echo $GLOBALS['server_root']?>/ressources/img/404.jpg"/>
    </div>
    <div class="returnHP">
         <button class="btn"><a href="<?php echo $GLOBALS['server_root']?>">Retour à l'accueil</a></button>
    </div>
</body>
</html>