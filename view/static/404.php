<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>\ressources\css\global.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/general.js"></script>
</head>
<body class="not-found-body">
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