<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/form.css">
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>

</head>

<div class="principal">
    <?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
    <?php
        /** @var Home $home */
        $home = $GLOBALS['view']['home'];
        $rooms = $home ->getRooms();
        $sensorsTypes = $GLOBALS['view']['sensors_types'];


    include_once($GLOBALS['root_dir'] . '/view/general/error.php')
    ?>

    <div class="margin-block-10"></div>

    <div class="user-add-sensor">
        <form method="post" class="hk-form">
            <h1  class="hk-title hk-text  sensors-text">Ajouter des capteurs </h1>
            <label class="hk-text sensors-text"> Sélectionnez votre capteur :</label><br>
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
                                . ' : ' . $sensorType -> getPrice() . '€</option>';
                            }
                        }
                        echo '</optgroup>';
                    }

                ?>
            </select><br>
            <label class="hk-text sensors-text">Numéro de série du capteur</label><br>
            <input type="text" name="sensorId"/><br>

            <label class="hk-text sensors-text">Sélectionnez la pièce où vous souhaitez ajouter les capteurs :</label><br>
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

            <input class="hk-btn" type="submit" value="Envoyer" />
            <div class="form-notice-message notice-message information-message">
                <p class="form-notice-message">Nous vous contacterons dans la semaine qui suit cet envoi</p>
            </div>
        </form>
    </div>

    <div class="user-delete-sensor">
        <?php $path =   explode( '/', $_SERVER['REQUEST_URI']);
        $endpointName = $path[count($path) - 1];
        $url = str_replace($endpointName, 'deleteSensor',$_SERVER['REQUEST_URI']);
        ?>
        <form method="post" action="<?php echo $url?>"  class="hk-form">
            <h1  class="hk-title hk-text sensors-text">Supprimer des capteurs</h1>
            <label class="hk-text hk-text sensors-text">Sélectionnez votre capteur :</label><br>
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
                                . ' - ' . $sensor -> getSensorType() -> getType()
                                . ' - Capteur n°' . $sensor -> getId() . '</option>';
                        }
                    }
                    echo '</optgroup>';
                }

                ?>
            </select><br>
            <input class="hk-btn" type="submit" value="Supprimer"/>
        </form>

    </div>
</div>


<?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
</body>

</html>