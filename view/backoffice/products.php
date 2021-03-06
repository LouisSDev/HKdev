<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Capteurs et les Effecteurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/general.js"></script>
</head>

<body>
<br>
<?php

include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");

$sensorsTypes = $GLOBALS['view']['sensors_types'];
$effectorsTypes = $GLOBALS['view']['effectors_types'];

include_once($GLOBALS['root_dir'] . '/view/general/error.php');

?>

<h1 class="hk-title toggleSensors">Les Capteurs<i class="fa fa-chevron-down" aria-hidden="true"></i></h1>
<div class="sensor-type">
    <div class="add-sensor-type">
        <form method="post" class="hk-form">
            <h2>Ajouter un nouveau capteur</h2>
            <label class="text"> Sélectionnez votre type de capteur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_SENSOR_TYPE"/>
            <select name="type">
                <?php
                foreach (SensorType::TYPE_ARRAY as $type){
                    echo '<option label="" value="'
                        . $type .'">'. $type
                        . '</option>';
                }
                ?>
            </select>
            <input type="text" name="name" placeholder="Nom">
            <input type="text" name="ref" placeholder="Référence"><br/>
            <input type="number" name="minVal" placeholder="Valeur minimale">
            <input type="number" name="maxVal" placeholder="Valeur maximale"><br/>
            <input type="text" name="price" placeholder="Prix"><br/>
            <input class="" type="submit" value="Ajouter" />
        </form>
    </div>

    <div class="add-sensors">
        <form method="post" class="hk-form">
            <h2>Ajouter des capteurs dans le stock </h2>
            <label class="text"> Sélectionnez votre capteur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_SENSORS"/>

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

            <label class="text">Sélectionnez le nombre de capteurs à ajouter :</label><br>
            <input type="number" name="sensorNb" placeholder="0"><br/>


            <input class="" type="submit" value="Ajouter" />
        </form>
    </div>

    <div class="delete-sensor-type">
        <form method="post" class="hk-form">
            <h2>Supprimer un type de capteur </h2>
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
            </select><br/>

            <input class="btn" type="submit" value="Supprimer" />


        </form>
    </div>
    <div class="edit-sensor-type">
        <form method="POST" class="hk-form">
            <h2>Modifier les informations d'un capteur</h2>
            <label class="text"> Sélectionnez votre capteur :</label><br>
            <input type="hidden" name="submittedForm" value="CHANGE_SENSORS_TYPE"/>
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
            <input type="text" name="name"  placeholder="Nom" />
            <input type="text" name="ref"  placeholder="Référence"/><br/>
            <input type="number" name="minVal" placeholder="Valeur minimale">
            <input type="number" name="maxVal" placeholder="Valeur maximale"><br/>
            <input type="text" name="price"  placeholder="Prix"/><br/>

            <input class="btn" type="submit" value="Modifier" />
        </form>
    </div>
</div>




<h1 class="hk-title toggleEffectors">Les Effecteurs<i class="fa fa-chevron-down" aria-hidden="true"></i></h1>
<div class="effector-type">
    <div class="addEffectorType">
        <form method="post" class="hk-form">
            <h2>Ajouter un nouvel effecteur</h2>
            <label class="text"> Sélectionnez votre type d'effecteur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_EFFECTOR_TYPE"/>
            <select name="type">
                <?php
                foreach (EffectorType::TYPE_ARRAY as $type){
                    echo '<option label="" value="'
                        . $type .'">'. $type
                        . '</option>';

                    }
                    ?>

            </select>
            <input type="text" name="name" placeholder="Nom">
            <input type="text" name="ref" placeholder="Référence"><br/>
            <input type="number" name="minVal" placeholder="Valeur minimale">
            <input type="number" name="maxVal" placeholder="Valeur maximale"><br/>



            <input class="btn" type="submit" value="Ajouter" />
        </form>
    </div>



    <div class="addEffectorTypeStock">
        <form method="post" class="hk-form">
            <h2>Ajouter des effecteurs dans le stock </h2>
            <label class="text"> Sélectionnez votre effecteur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_EFFECTORS"/>

            <select name="effectorTypeId">
                <?php
                foreach (EffectorType::TYPE_ARRAY as $type){

                    echo '<optgroup label="'. $type . '">';

                    /** @var  $effectorType EffectorType*/
                    foreach ($effectorsTypes as $effectorType) {

                        if ($effectorType->getType() === $type && $effectorType -> getSelling()) {
                            echo '<option label="" value="'
                                . $effectorType -> getId() . '">'
                                . $type . ' : ' . $effectorType -> getName()
                                . ' - ' . $effectorType -> getRef()
                                . '</option>';
                        }
                    }
                    echo '</optgroup>';
                }
                ?>
            </select><br>

            <label class="text">Sélectionnez le nombre d'effecteur à ajouter :</label><br>
            <input type="number" name="effectorNb" placeholder="0"><br/>


            <input class="btn" type="submit" value="Ajouter" />
        </form>
    </div>



    <div class="removeEffectorType">
        <form method="post" class="hk-form">
            <h2>Supprimer un type d'effecteur</h2>
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
                                . ' - ' . $effectorType -> getRef()
                                . '</option>';
                        }
                    }
                    echo '</optgroup>';

                }
                ?>
            </select><br/>
            <input class="btn" type="submit" value="Supprimer" />
        </form>
    </div>

        <div class="editEffector">
            <form method="POST" class="hk-form">
                <h2>Modifier les informations d'un effecteur</h2>
                <label class="text"> Sélectionnez votre effecteur :</label><br>
                <input type="hidden" name="submittedForm" value="CHANGE_EFFECTORS_TYPE"/>
                <select name="effectorType">
                    <?php
                    foreach (EffectorType::TYPE_ARRAY as $type){

                        echo '<optgroup label="'. $type . '">';

                        /** @var  $effectorType EffectorType*/
                        foreach ($effectorsTypes as $effectorType) {

                            if ($effectorType->getType() === $type && $effectorType -> getSelling()) {
                                echo '<option label="" value="'
                                    . $effectorType -> getId() . '">'
                                    . $type . ' : ' . $effectorType -> getName()
                                    . ' - ' . $effectorType -> getRef()
                                    . '</option>';
                            }
                        }
                        echo '</optgroup>';
                    }
                    ?>
                </select><br>
                <input type="text" name="name"  placeholder="Nom" />
                <input type="text" name="ref"  placeholder="Référence"/><br/>
                <input type="number" name="minVal" placeholder="Valeur minimale">
                <input type="number" name="maxVal" placeholder="Valeur maximale"><br/>
                <input type="text" name="price"  placeholder="Prix"/><br/>

                <input class="btn" type="submit" value="Modifier" />
            </form>
        </div>
    </div>

</div>
</body>
