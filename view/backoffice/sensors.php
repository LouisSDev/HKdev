<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Capteurs et les Effecteurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/products.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");?>
</head>

<body>
<?php

$sensorsTypes = $GLOBALS['view']['sensors_types'];

include_once($GLOBALS['root_dir'] . '/view/general/error.php');

?>
<h1>Supprimer un type de capteur </h1>
<label class="text"> Sélectionnez votre capteur :</label><br>
<input type="hidden" name="submittedForm" value="REMOVE_SENSOR_TYPE"/>
<select name="sensorType">
    <?php
    foreach (SensorType::TYPE_ARRAY as $type){

        echo '<optgroup label="'. $type . '">';

        /** @var  $sensorType SensorType*/
        foreach ($sensorsTypes as $sensorType) {

            if ($sensorType->getType() === $type && $sensorType -> getSelling()) {
                echo '<option label="" value="'
                    . $sensorType -> getId() . '">'
                    . $type . ' : ' . $sensorType -> getName()
                    . ' - ' . $sensorType -> getRef()
                    . '</option>';
            }
        }
        echo '</optgroup>';

    }
    ?>
</select><br>

</body>
