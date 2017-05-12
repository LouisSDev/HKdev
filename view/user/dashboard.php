<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/editProfile.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
</head>
<body>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;
include_once($GLOBALS['root_dir'] . '/view/general/header.php') ?>
<h1>TABLEAU DE BORD</h1>
<h3>Bonjour <?php echo $user -> getFirstName()?></h3>
</body>
</html>
