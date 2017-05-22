<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>

<body>
<br>


<dv class="tableauDelete">
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


</body>
</html>