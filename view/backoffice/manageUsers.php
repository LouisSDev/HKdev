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

$userRepo =$this-> getUserRepository();
$home = $GLOBALS['view']['home'];
$room = $GLOBALS['view']['room'];

$users =$this-> $userRepo->getAll();
include_once($GLOBALS['root_dir'] . '/view/general/error.php');

?>

    <div class="select">
        <form method="post">
            <label class="text"> Sélectionnez l'utilisateur :</label><br>
            <input type="hidden" name="submittedForm" value="ADD_HOME"/>
            <select name="user">
                <?php
                /** @var  $user User*/
                foreach ($users as $user) {

                    echo '<option label="user" value="'
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
            <input type="number" name="rooms" >

            <select name="homeType">
                <option>Maison</option>
                <option>Immeuble</option>
            </select>

            <input class="btn" type="submit" value="Ajouter" />


        </form>
    </div>

</body>