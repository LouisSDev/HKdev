<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ajoutCapteur</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
</head>
<body>
    <?php
        /** @var Home $home */
        $home = $GLOBALS['home'];
        $rooms = $home -> getRooms();
        $sensorsTypes = $GLOBALS['sensors_types'];
    ?>

    <div><form>
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
        <label>Quantité</label><br>
        <input type="number" step="1" value="1" min="0" max="20"><br>

        <label>Sélectionnez la pièces ou vous souhaitez ajouter les capteurs :</label><br>
        <select multiple>
            <option selected label="aucune" value="">Aucune</option>
            <optgroup label="Rez de chaussé">
                <option value="">Cuisine</option>
                <option value="">Sallon</option>
                <option value="">Bureau</option>
            </optgroup>
            <optgroup label="1e Etage">
                <option value="">Chambre enfant 1</option>
                <option value="">Chambre des parents</option>
                <option value="">Salle de Bain </option>
            </optgroup>
            <optgroup label="2e Etage">
                <option value="">Salle de Jeu</option>
            </optgroup>
        </select> <br>

        <input class="btn" type="submit" value="Envoyer" />
        <p class="text">Nous vous contacterons dans la semaine qui suit cet envoie</p>
        </form></div>


</body>
</html>