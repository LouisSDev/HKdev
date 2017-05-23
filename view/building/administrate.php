<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/administrate.css">

</head>

<body class="administrate-body">
<?php

 include_once ($GLOBALS['root_dir'] . "/view/general/header.php");
/**
 * @var User $user
 */
$user = $GLOBALS['view']['user'];

/** @var Home $building */
$building = $GLOBALS['view']['building'];

?>


<br>
<br>
<br>


<?php include_once($GLOBALS['root_dir'] . '/view/general/error.php')  ?>

<form class="hk-form" id="administrate-form" method="post" >

    <h3> Attribuer de nouveaux identifiants</h3>

    <select name="homeId" class="home administrate-select">

        <?php

        /**
         * @var Home $home
         */
        foreach ($building -> getHomes() as $home){

            if($home->getBuilding() === $building){

                echo '<option label="" value="' . $home ->getId() . '" >'
                    . $home -> getName()
                    . ' - ' . $home -> getUser() -> getLastName()
                    . ' ' . $home->getUser()->getFirstName()
                    .'</option>';

            }

        }
        ?>
    </select><br>

    <div>
        <input class="administrate-input" type ="password" name="adminPassword" placeholder="Votre mot de passe administrateur" ><br>
        <input class="administrate-input" type="text" name="firstName" placeholder="Nom du nouveau locataire"><br>
        <input class="administrate-input" type="text" name="lastName" placeholder="Prénom du nouveau locataire"><br>
    </div>
    <div>
        <input class="administrate-input" type="email" name="mail" placeholder="Email temporaire"><br>
        <input class="administrate-input" type="password" name="password" placeholder="mot de passe temporaire"><br>
        <input class="administrate-input" type="password" name="passwordConf" placeholder="Confirmation du mot de passe temporaire"><br>
    </div><br>

    <input class="administrate-input" id="administrate-submit"  type="submit" value="Valider">



</form>

</body>
</html>