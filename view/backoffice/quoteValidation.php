<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Capteurs et les Effecteurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/quoteValidation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");?>
</head>

<body>
<br>
<?php

$user = $GLOBALS['view']['user'];

include_once($GLOBALS['root_dir'] . '/view/general/error.php');



?>
<h1>Devis à valider </h1>
<div class="aValider">
    <div class="valider">
        <?php
        foreach (SensorType::TYPE_ARRAY as $type){

            echo '<optgroup label="'. $type . '">';


            echo '</optgroup>';

        }
        ?>

            <input class="btn" type="submit" value="Valider" />

    </div>
</div>

<div class="tableauAdd">

</div>


</body>