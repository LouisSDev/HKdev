<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/chart/chartManageUsers.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
</head>

<body>
<br>
<?php

include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");
include_once($GLOBALS['root_dir'] . '/view/general/error.php');


$homes = $GLOBALS['view']['homes'];
$rooms = $GLOBALS['view']['rooms'];
$users = $GLOBALS['view']['users'];


?>

    <div class="addHome">
        <h1>Ajouter une maison à un utilisateur</h1>
        <form method="post">
            <label class="text"> Sélectionnez l'utilisateur :</label><br>
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

            <select name="homeType">
                <option value="house">Maison</option>
                <option value="building">Immeuble</option>
            </select>
            <br>
            <br>
            <input class="btn" type="submit" value="Ajouter" />


        </form>
    </div>


<div class="deleteHome">
    <h1>Supprimer une maison à un utilisateur</h1>
    <form method="post">

        <label class="text"> Sélectionnez la maison à supprimer :</label><br>
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
    <h1>Supprimer un pièce</h1>
    <form method="POST">
        <label class="text">Sélectionnez une maison dans laquelle vous voulez supprimer une pièce :</label>
        <input type="hidden" name="submittedForm" value="DELETE_ROOM"/>
        <select id="homeId">
            <?php

            /**
             * @var Home $home
             */
            foreach ($homes as $home){

                if(!$home->getHasHomes()){

                    echo '<option label="" value="' . $home ->getId() . '" >'
                        . $home -> getName() . ' - ' . $home -> getBuilding() -> getName()
                        .'</option>';
                }
            }
            ?>
        </select><br>
        <label class="text">Sélectionnez une pièce à supprimer :</label>
        <select id="roomId">
            <?php
            foreach (Room::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type .'">';

                /** @var Room $room */
                foreach ($rooms as $room){
                    if ($room -> getType() === $type ) {
                        echo '<option class="roomSelector" homeId="' . $room -> getHome() -> getId()
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

<div class="deleteUser">
    <h1>Supprimer un utilisateur</h1>
    <form method="post">

        <label class="text"> Sélectionnez l'utilisateur :</label><br>
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
</body>