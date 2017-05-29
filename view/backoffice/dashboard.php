<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/user/dashboard.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>

    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>

</head>
<body>
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php"); ?>

    //nb de user

    <?php
    echo $GLOBALS['view']['sensorStock'];
    echo $GLOBALS['view']['effectorStock'];
    ?>

    //nb de capteurs actifs

    //nb de capteurs supprimés
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
</body>




