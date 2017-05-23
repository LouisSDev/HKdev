<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>\ressources\css\global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>\ressources\css\error404.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
</head>
<body>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/modal.php")?>
<div class="content">
    <div class="notFound">
        <img class="oups" src="<?php echo $GLOBALS['server_root']?>/ressources/img/404.jpg"/>
    </div>
</div>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
</body>
</html>