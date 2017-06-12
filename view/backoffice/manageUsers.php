<html xmlns="http://www.w3.org/1999/html" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/general.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/manageUser.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/form.css">
</head>

<body>
<br>
<?php

include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");
include_once($GLOBALS['root_dir'] . '/view/general/error.php');

//$effectorsTypes = $GLOBALS['view']['effectors_types'];
$homes = $GLOBALS['view']['homes'];
$rooms = $GLOBALS['view']['rooms'];
$users = $GLOBALS['view']['users'];
$effectors = $GLOBALS['view']['effectors'];
$effectorsTypes = $GLOBALS['view']['effector_types']


?>

    <div class="addHome">
        <form method="post" class="hk-form">
            <p class="hk-title">Ajouter une maison à un utilisateur</p>
            <label class="hk-text"> Sélectionnez l'utilisateur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_HOME"/>
            <select name="selectUser">
                <?php
                /** @var  User $user*/
                foreach ($users as $user) {

                    echo '<option label="" value="'
                        . $user -> getId() . '">'
                        . $user -> getFirstName() . ' '
                        . $user -> getLastName()
                        . '</option>';

                }
                ?>
            </select><br>


            <input type="text" name="name" placeholder="Nom de la Maison">
            <input type="text" name="address" placeholder="Adresse">
            <input type="text" name="city" placeholder="Ville">
            <input type="text" name="country" placeholder="Pays">

            <select id="homeType" name="homeType">
                <option value="house">Maison</option>
                <option value="building">Immeuble</option>
            </select>
            <select id="buildingId" name="buildingId">
                <option label="" value="-1">Cette maison n'appartient à aucun immeuble</option>
                <?php

                /**
                 * @var Home $home
                 */
                foreach ($homes as $home){

                    if($home->getHasHomes()){

                        echo '<option label="" value="' . $home ->getId() . '" >'
                            . $home -> getName()
                            .'</option>';
                    }
                }
                ?>
            </select><br>
            <br>
            <br>
            <input class="btn" type="submit" value="Ajouter" />


        </form>
    </div>


<div class="deleteHome">
    <form method="post" class="hk-form">
        <p class="hk-title">Supprimer la maison ou l'immeuble d'un utilisateur</p>
        <label class="hk-text"> Sélectionnez la maison à supprimer :</label><br>
        <input type="hidden" name="submittedForm" value="DELETE_HOME"/>
        <select name="home">
            <?php

            /** @var  Home $hm*/
            foreach ($homes as $hm) {

                echo '<option label="" value="'
                    . $hm -> getId() . '">'
                    . $hm -> getName() . ' '
                    . $hm -> getAddress() . ' '
                    . $hm -> getCity(). ' '
                    . $hm -> getCountry()
                    . '</option>';

            }
            ?>
        </select><br>


        <input class="btn" type="submit" value="Supprimer" />


    </form>
</div>

<div class="deleteRoom">
    <form method="POST" class="hk-form">
        <p class="hk-title"> Supprimer la pièce d'un utilisateur</p>
        <p class="hk-text">Sélectionnez la maison à laquelle appartient la pièce à supprimer:</p>
        <input type="hidden" name="submittedForm" value="DELETE_ROOM"/>
        <select name="homeId" id="homeId">
            <option label="" value="">Aucune maison sélectionnée</option>
            <?php

            /**
             * @var Home $home
             */
            foreach ($homes as $home){

                if(!$home->getHasHomes()){

                    $buildingName = $home -> getName();
                    if($home->getBuilding()){
                        $buildingName = $home->getBuilding()->getName();
                    }

                    echo '<option label="" value="' . $home ->getId() . '" >'
                        . $home -> getName() . ' - ' . $buildingName
                        .'</option>';
                }
            }
            ?>
        </select><br>
        <p class="hk-text">Sélectionnez une pièce à supprimer :</p>
        <select name="roomId" id="roomId">
            <?php
            foreach (Room::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type .'">';

                /** @var Room $room */
                foreach ($rooms as $room){
                    if ($room -> getType() === $type ) {
                        echo '<option  class="roomSelector-deleteRoom" homeId="' . $room -> getHome() -> getId()
                            . '" label="" value="' . $room -> getId() .'">'
                            . $room -> getName() . '</option>';
                    }
                }
                echo '</optgroup>';
            }
            ?>
            <input class="btn" type="submit" value="Supprimer" />

        </select><br>
    </form>
</div>

<div class="addRoom">
    <form method="POST" class="hk-form">
        <p class="hk-title"> Ajouter une pièce</p>
        <input type="hidden" name="submittedForm" value="ADD_ROOM">
        <p class="hk-text">Sélectionnez un type de pièce :</p>
        <select name="type">
            <?php

            foreach (Room::TYPE_ARRAY as $type){
                echo '<option label="" value="'
                    . $type .'">'. $type
                    . '</option>';

            }

            ?>

        </select><br>

        <input type="text" name="name" placeholder="Nom de la nouvelle pièce">

        <select name="homeId" id="homeId-addRoom">
            <?php

            /**
             * @var Home $home
             */
            foreach ($homes as $home){

                if(!$home->getHasHomes()){

                    $buildingName = $home -> getName();
                    if($home->getBuilding()){
                        $buildingName = $home->getBuilding()->getName();
                    }

                    echo '<option label="" value="' . $home ->getId() . '" >'
                        . $home -> getName() . ' - ' . $buildingName
                        .'</option>';
                }
            }
            ?>
        </select><br>

        <input class="btn" type="submit" value="Ajouter" />
    </form>
</div>

<div class="deleteUser">
    <form method="post" class="hk-form">
        <p class="hk-title">Supprimer un utilisateur</p>
        <label class="hk-text"> Sélectionnez l'utilisateur :</label><br>
        <input type="hidden" name="submittedForm" value="DELETE_USER"/>
        <select name="deleteUser">
            <?php

            /** @var  Home $hm*/
            foreach ($users as $user) {

                echo '<option label="" value="'
                    . $user -> getId() . '">'
                    . $user -> getFirstName() . ' '
                    . $user -> getLastName()
                    . '</option>';

            }
            ?>
        </select><br>
        <input class="btn" type="submit" value="Supprimer" />
    </form>
</div>

<div class="addEffector">
    <form method="POST" class="hk-form">
        <input type="hidden" name="submittedForm" value="ADD_EFFECTOR"/>
        <h1  class="hk-title hk-text  sensors-text">Ajouter des effecteurs à une pièce </h1>
        <label class="hk-text sensors-text"> Sélectionnez votre effecteur :</label><br>
        <select name="effectorType">
            <?php
            foreach (EffectorType::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type . '">';

                /** @var  $effType EffectorType*/
                foreach ($effectorsTypes as $effType) {

                    if ($effType->getType() === $type && $effType -> getSelling()) {
                        echo '<option label="" value="'
                            . $effType -> getId() . '">'
                            . $type . ' : ' . $effType -> getName()
                            . ' - ' . $effType -> getRef(). '</option>';
                    }
                }
                echo '</optgroup>';
            }

            ?>
        </select><br>
        <label class="hk-text sensors-text">Numéro de série de l'effecteur</label><br>
        <input type="text" name="effectorId"/><br>
        <label class="hk-text sensors-text">Nom de l'efffecteur</label><br>
        <input type="text" name="name"/><br>

        <label class="hk-text sensors-text">Sélectionnez la pièces ou vous souhaitez ajouter les effecteurs :</label><br>

        <select name="homeId" id="homeId-addEffector">
            <option selected label="aucune" value="-1">Aucune</option>
            <?php

            /**
             * @var Home $home
             */
            foreach ($homes as $home){

                if(!$home->getHasHomes()){

                    $buildingName = $home -> getName();
                    if($home->getBuilding()){
                        $buildingName = $home->getBuilding()->getName();
                    }

                    echo '<option label=""  value="' . $home ->getId() . '" >'
                        . $home -> getName() . ' - ' . $buildingName
                        .'</option>';
                }
            }
            ?>
        </select><br>
        <select name="roomId">
            <?php
            foreach (Room::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type .'">';

                /** @var Room $room */
                foreach ($rooms as $room){
                    if ($room -> getType() === $type ) {
                        echo '<option label="" homeId="' . $room -> getHome() -> getId() . '"  value="'
                            . $room -> getId() .'" class ="roomSelector-addEffector">'
                            . $room -> getName() . '</option>';
                    }

                }
                echo '</optgroup>';
            }
            ?>
        </select>
        <br>

        <input class="hk-btn" type="submit" value="Envoyer" />
        <div class="form-notice-message notice-message information-message">
            <p class="form-notice-message">Vous devez sélectionner un effecteur dont vous disposez réellement dans vos stocks.</p>
        </div>

    </form>
</div>

<div class="deleteEffector">
    <form method="POST" class="hk-form">
        <input type="hidden" name="submittedForm" value="DELETE_EFFECTOR"/>
        <h1  class="hk-title hk-text  sensors-text">Supprimer un effecteur</h1>
        <label class="hk-text sensors-text">Numéro de série de l'effecteur</label><br>
        <label class="hk-text sensors-text">Sélectionnez la pièces ou vous souhaitez supprimer les effecteurs :</label><br>

        <select name="homeId" id="homeId-deleteEffector">
            <option selected label="aucune" value="-1">Aucune</option>
            <?php

            /**
             * @var Home $home
             */
            foreach ($homes as $home){

                if(!$home->getHasHomes()){

                    $buildingName = $home -> getName();
                    if($home->getBuilding()){
                        $buildingName = $home->getBuilding()->getName();
                    }

                    echo '<option label=""  value="' . $home ->getId() . '" >'
                        . $home -> getName() . ' - ' . $buildingName
                        .'</option>';
                }
            }
            ?>
        </select><br>
        <select name="roomId" id="roomId-deleteEffector">
            <option selected label="aucune" value="-1">Aucune</option>
            <?php
            foreach (Room::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type .'">';

                /** @var Room $room */
                foreach ($rooms as $room){
                    if ($room -> getType() === $type ) {
                        echo '<option label="" homeId="' . $room -> getHome() -> getId() . '"  value="'
                            . $room -> getId() .'" class ="roomSelector-deleteEffector">'
                            . $room -> getName() . '</option>';
                    }

                }
                echo '</optgroup>';
            }
            ?>
        </select>
        <select name="effectorId">
            <?php
            foreach (EffectorType::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type .'">';


                /** @var Effector $eff */
                foreach ($effectors as $eff){

                    if ($eff -> getEffectorType() -> getType() === $type ) {

                        $room = $eff -> getRoom();
                        echo '<option label="" roomId="' . $room -> getId() . '"  value="'
                            . $eff -> getId() .'" class ="effectorSelector-deleteEffector">'
                            . $room -> getName() . ' : ' . $eff -> getName() . '</option>';
                    }

                }
                echo '</optgroup>';
            }
            ?>
        </select>
        <br>

        <input class="hk-btn" type="submit" value="Envoyer" />
        <div class="form-notice-message notice-message information-message">
            <p class="form-notice-message">Attention, cette opération est irrémédiable et desactivera un effecteur sans qu'il puisse etre réutilisé plus tard.</p>
        </div>

    </form>
</div>
</body>
</html>