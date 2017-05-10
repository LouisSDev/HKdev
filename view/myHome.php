<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ma maison</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/myHome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
</head>
<body>
    <?php include_once("general/header.php");?>
    <div class="home">
        <i class="fa fa-home iconHome" aria-hidden="true" style="cursor:pointer;"></i>
    </div>
    <div class="rooms">
        <i class="fa fa-bed iconBed" aria-hidden="true" style="cursor:pointer;"></i>
        <i class="fa fa-cutlery iconKitchen" aria-hidden="true" style="cursor:pointer;"></i>
        <i class="fa fa-bath iconBath" aria-hidden="true" style="cursor:pointer;"></i>
        <i class="fa fa-television iconSofa" aria-hidden="true" style="cursor:pointer;"></i>
    </div>
</body>
</html>