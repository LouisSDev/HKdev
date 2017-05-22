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
        <form method="post">
            <label class="text"> Sélectionnez l'utilisateur :</label><br>
            <input type="hidden" name="submittedForm" value="SELECT_USER"/>
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


            <input type="text" name="NomHome" placeholder="Nom de la Maison">
            <input type="text" name="Adress" placeholder="Adresse">
            <input type="text" name="Ville" placeholder="Ville">
            <input type="text" name="Pays" placeholder="Pays">

            <select name="homeType">
                <option value="true">Maison</option>
                <option value="false">Immeuble</option>
            </select>
            <br>
            <label class="texte">Choisissez le nombre de pièces par type :</label>
            <input type="number" name="ROOM" placeholder="0" min="0">
            <input type="number" name="LIVING_ROOM" placeholder="0" min="0">
            <input type="number" name="KITCHEN" placeholder="0" min="0">
            <br>
            <input class="btn" type="submit" value="Ajouter" />


        </form>
    </div>

</body>