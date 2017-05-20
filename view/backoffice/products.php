<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Capteurs et les Effecteurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/products.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
</head>

<body>
<br>
<?php

include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");

$sensorsTypes = $GLOBALS['view']['sensors_types'];
$effectorsTypes = $GLOBALS['view']['effectors_types'];

include_once($GLOBALS['root_dir'] . '/view/general/error.php');

?>

<div class="tableauDelete">
    <div class="suppression">
        <form method="post">
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

            <input class="btn" type="submit" value="supprimer" />


        </form>
    </div>

    <div class="ajouts">
        <form method="post">
            <h1>Ajouter des capteurs dans le stock </h1>
            <label class="text"> Sélectionnez votre capteur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_SENSOR_TYPE"/>

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
            <!--
            <label>Quantité</label><br>
            <input type="number" step="1" value="1" min="0" max="20" name="quantity"/><br>
            -->

            <label class="text">Sélectionnez le nombre de capteurs à ajouter :</label><br>
            <input type="number" name="sensorNb">


            <input class="btn" type="submit" value="Ajouter" />
        </form>
    </div>

    <div class="supression">
        <form method="post">
            <h1>Supprimer un type d'effecteur</h1>
            <label class="text">Selectionnez votre effecteur :</label>
            <input type="hidden" name="submittedForm" value="REMOVE_EFFECTOR_TYPE"/>
            <select name="effectorType">
                <?php
                foreach (EffectorType::TYPE_ARRAY as $type){

                    echo '<optgroup label="'. $type .'">';

                    /** @var  EffectorType $effectorType*/
                    foreach ($effectorsTypes as $effectorType) {

                        if ($effectorType->getType() === $type && $effectorType -> getSelling()) {
                            echo '<option label="" value="'
                                . $effectorType -> getId() . '">'
                                . $type . ' : ' . $effectorType -> getName()
                                . ' - ' . $effectorType -> getRef(). '</option>';
                        }
                    }
                    echo '</optgroup>';

                }
                ?>
            </select><br>

            <input class="btn" type="submit" value="Envoyer" />

        </form>
    </div>
</div>

</body>