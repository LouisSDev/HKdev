<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lol</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/lol.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/lol.js"></script>
</head>

<body>
<div class="temp">
    <input class="value" type="number" step="1" value="15" min="0" max="25">
    <p class="info">Température</p>

</div>

<div class="lum">
    <input type="range"  min="0" max="100" />
    <p class="info">Luminosité</p>
</div>

<div class="volets">
    <i class="fa fa-toggle-off" id="off" aria-hidden="true" style="cursor:pointer;"></i>
    <i class="fa fa-toggle-on" id="on" aria-hidden="true" style="cursor:pointer;"></i>
    <p class="info">Volets automatique</p>

</div>

</body>

