<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Capteurs et les Effecteurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/products.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
</head>

<body>

<?php

$sensorsTypes = $GLOBALS['view']['sensors_types'];
$effectorsTypes = $GLOBALS['view']['effectors_types'];


include_once($GLOBALS['root_dir'] . '/view/general/error.php')
?>

<div class="tableauDelete">
    <div class="suppression">
        <form method="post">
            <h1>Supprimer un type de capteur </h1>
            <label class="text"> Sélectionnez votre capteur :</label><br>
            <select name="sensorType">
                <?php
                foreach (SensorType::TYPE_ARRAY as $type){

                    echo '<optgroup label="'. $type . '">';

                    /** @var  $sensorType SensorType*/
                    foreach ($sensorsTypes as $sensorType) {

                        if ($sensorType->getType() === $type) {
                            echo '<option label="" value="'
                                . $sensorType -> getId() . '">'
                                . $type . ' : ' . $sensorType -> getName()
                                . ' - ' . $sensorType -> getRef()
                                . ' : ' . $sensorType -> getPrice() . '€</option>';
                        }
                    }
                    echo '</optgroup>';

                }


                ?>
            </select><br>

            <input class="btn" type="submit" value="Envoyer" />

            <?php
            if (isset($_POST['submit']))
            {

            }
            ?>
        </form>
    </div>
</div>

<div class="tableauAdd">

</div>

</body>