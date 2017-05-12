<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../rooting.php">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
</head>
<body>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;
include_once($GLOBALS['root_dir'] . '/general/header.php') ?>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/modal.php")?>
<h1>TABLEAU DE BORD</h1>
<h3>Bonjour <?php echo $user -> getFirstName()?></h3>
</body>
</html>
