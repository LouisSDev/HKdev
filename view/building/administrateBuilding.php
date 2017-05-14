<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout Capteur</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">

</head>
<?php
/**
 * @var User $user
 */
$user = $GLOBALS['view']['user'];
$homes =$user->getHomes();

$building = $GLOBALS['view']['building'];

if(isset($GLOBALS['view']['message'])) {
    echo '<p>' . $GLOBALS['view']['message'] . '</p>';
}
?>
<h1> Attribuer de nouveaux identifiants</h1>

<form method="post" class="newUser">
    <div class="col1">
        <input type ="password" name="adminPassword" placeholder="votre mot de passe administrateur" >
        <input type="text" name="newUserName" placeholder="Nom du nouveau locataire">
        <input type="text" name="newUserSurname" placeholder="Prénom du nouveau locataire">
    </div>
    <div class="col2">
        <input type="email" name="newUserMail" placeholder="email temporaire">
        <input type="password" name="newUserPassword" placeholder="mot de passe temporaire">
        <select name="building">
            <?php

            if(!$building->hasHome()){
                /**
                 * @var Home $home
                 */
                foreach ($homes as $home){

                    if($home->getBuilding() === $building){

                        echo '<option label="" value="' . $home ->getId() . '">'
                            . $home->getName()
                            . ' - '.'' . $home -> getUser()->getLastName().$home->getUser()->getFirstName()
                            .'</option>';

                    }

                }

            }

            ?>

        </select>
        <input class="btn" type="submit" value="Valider">
    </div>

</form>
