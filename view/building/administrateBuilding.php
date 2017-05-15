<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $GLOBALS['view']['title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">

</head>
<?php
/**
 * @var User $user
 */
$user = $GLOBALS['view']['user'];

/** @var Home $building */
$building = $GLOBALS['view']['building'];

if(isset ($GLOBALS['view']['success_message'])){ ?>
    <div class="success-message">
        <?php echo $GLOBALS['view']['success_message'] ?>
    </div>
    <?php
}
elseif( isset($GLOBALS['view']['error'])) { ?>
    <div class="error-message">
        <?php echo $GLOBALS['view']['error'] ?>
    </div>
    <?php
}
?>
<h1> Attribuer de nouveaux identifiants</h1>

<form method="post" class="newUser">
    <div class="col1">
        <input type ="password" name="adminPassword" placeholder="votre mot de passe administrateur" >
        <input type="text" name="firstName" placeholder="Nom du nouveau locataire">
        <input type="text" name="lastName" placeholder="Prénom du nouveau locataire">
    </div>
    <div class="col2">
        <input type="email" name="mail" placeholder="email temporaire">
        <input type="password" name="password" placeholder="mot de passe temporaire">
        <input type="password" name="passwordConf" placeholder="Confirmation du mot de passe temporaire">
        <select name="homeId">

        <?php

            /**
             * @var Home $home
             */
            foreach ($building -> getHomes() as $home){

                if($home->getBuilding() === $building){

                    echo '<option label="" value="' . $home ->getId() . '">'
                        . $home -> getName()
                        . ' - ' . $home -> getUser() -> getLastName()
                        . ' ' . $home->getUser()->getFirstName()
                        .'</option>';

                }

            }
        ?>
        </select>


        <input class="btn" type="submit" value="Valider">
    </div>

</form>
