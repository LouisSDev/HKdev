<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
</head>

<body>
<br>
<?php

include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");
include_once($GLOBALS['root_dir'] . '/view/general/error.php');


$home = $GLOBALS['view']['home'];
$room = $GLOBALS['view']['room'];
$users = $GLOBALS['view']['users'];


?>

    <div class="select">
        <h1>Ajouter une maison à un utilisateur</h1>
        <form method="post">
            <label class="text"> Sélectionnez l'utilisateur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_HOME"/>
            <select name="user">
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
                <option value="true">Maison</option>
                <option value="false">Immeuble</option>
            </select>
            <br>
            <br>
            <label class="texte">Choisissez le nombre de pièces par type :</label><br>
            <label>Chambres : <input type="number" name="BED_ROOM" placeholder="0" min="0"></label><br>
            <label>Salon : <input type="number" name="LIVING_ROOM" placeholder="0" min="0"></label><br>
            <label>Cuisine : <input type="number" name="KITCHEN" placeholder="0" min="0"></label><br>
            <label>Pièces en plus : <input type="number" name="ROOM" placeholder="0" min="0"></label><br>
            <br>
            <input class="btn" type="submit" value="Ajouter" />


        </form>
    </div>


<div class="delete">
    <h1>Supprmier une maison à un utilisateur</h1>
    <form method="post">
        <label class="text"> Sélectionnez l'utilisateur :</label><br>
        <input type="hidden" name="submittedForm" value="DELETE_HOME"/>
        <select name="user">
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
        </select>
        <br>
        <br>
        <label class="text"> Sélectionnez la maison à supprimer :</label><br>
        <select name="home">
            <?php
            /** @var  Home $home*/
            foreach ($homes as $home) {

                echo '<option label="" value="'
                    . $home -> getAddress() . ' '
                    . $home -> getCity(). ' '
                    . $home -> getCountry()
                    . '</option>';

            }
            ?>
        </select><br>


        <input class="btn" type="submit" value="Supprimer" />


    </form>
</div>
</body>