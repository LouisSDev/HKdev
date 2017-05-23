<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>

<body>
<br>

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


</body>
</html>