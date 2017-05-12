<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../rooting.php">
</head>
<body>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;
include_once(__DIR__ . '/general/header.php') ?>
<h1>TABLEAU DE BORD</h1>
<h3>Bonjour <?php echo $user -> getFirstName()?></h3>
</body>
</html>
