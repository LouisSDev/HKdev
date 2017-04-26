<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="sphere.css">
</head>
<body>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;
include_once('view/header.php') ?>
<h1>DASHBOARD</h1>
<h3> Hello <?php echo $user -> getFirstName()?></h3>
</body>
</html>