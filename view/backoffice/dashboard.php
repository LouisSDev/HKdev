<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $GLOBALS['view']['page_title']?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/backOffice.css">

    <script src="https://d3js.org/d3.v4.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>

    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/general.js"></script>
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");
    ?>

</head>
<body>

<div id="sensortest"   value="<?php echo $GLOBALS['view']['sensorStock']?>"></div>
    <input type="hidden" id="sensorStock" value="<?php echo $GLOBALS['view']['sensorStock']?>">
    <input type="hidden" id="effectorStock" value="<?php echo $GLOBALS['view']['effectorStock']?>">


    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/chart/back_office_chart.js"></script>

</body>




