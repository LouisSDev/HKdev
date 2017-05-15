<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout Capteur</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
</head>
<div>
    <?php
        /** @var Home $home */
        $home = $GLOBALS['view']['home'];
        $rooms = $home ->getRooms();
        $sensorsTypes = $GLOBALS['view']['sensors_types'];

        if(isset($GLOBALS['view']['message'])) {
             echo '<p>' . $GLOBALS['view']['message'] . '</p>';
        }
    ?>

    <div>
        <form method="post">
            <p class="text">Ajouter des capteurs </p>
            <label>Sélectionnez votre capteur :</label><br>
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
            <!--
            <label>Quantité</label><br>
            <input type="number" step="1" value="1" min="0" max="20" name="quantity"/><br>
            -->
            <label>Numéro de série du capteur</label><br>
            <input type="number" name="sensorId"/><br>

            <label>Sélectionnez la pièces ou vous souhaitez ajouter les capteurs :</label><br>
            <select name="room">
                <option selected label="aucune" value="">Aucune</option>
                <?php
                    foreach (Room::TYPE_ARRAY as $type){

                        echo '<optgroup label="'. $type .'">';

                        /** @var Room $room */
                        foreach ($rooms as $room){
                            if ($room -> getType() === $type ) {
                                echo '<option label="" value="'
                                . $room -> getId() .'">'
                                . $room -> getName() . '</option>';
                            }

                        }
                        echo '</optgroup>';
                    }
                ?>
            </select> <br>

            <input class="btn" type="submit" value="Envoyer" />
            <p class="text">Nous vous contacterons dans la semaine qui suit cet envoie</p>
        </form>
    </div>

    <div>
        <?php $path =   explode( '/', $_SERVER['REQUEST_URI']);
        $endpointName = $path[count($path) - 1];
        $url = str_replace($endpointName, 'deleteSensor',$_SERVER['REQUEST_URI']);
        ?>
        <p class="text">Supprimer des capteurs</p>
        <label>Sélectionnez votre capteur :</label><br>
        <form method="post" action="<?php echo $url?>">
        <select name="sensorId">
            <?php
            foreach (SensorType::TYPE_ARRAY as $type){


                echo '<optgroup label="'. $type . '">';


                /** @var  $sensor Sensor*/
                foreach ($home -> getAllSensors() as $sensor) {


                    if ($sensor -> getSensorType() -> getType() === $type) {
                        echo '<option label="" value="'
                            . $sensor -> getId() . '">'
                            . $sensor -> getRoom() -> getName()
                            . ' - Capteur n°' . $sensor -> getId() . '</option>';
                    }
                }
                echo '</optgroup>';
            }



            ?>
        </select><br>
        <input class="btn" type="submit" value="Supprimer"/>
        </form>

    </div>
</div>



</body>
</html>