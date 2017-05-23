<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/editProfile.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/editProfile.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>


</head>
<body>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/modal.php")?>
<?php include_once($GLOBALS['root_dir'] . '/view/general/error.php') ?>


<div class="container">
        <h2 id="infoTitle">Editer mes infos personnelles <i class="fa fa-chevron-down" aria-hidden="true"></i></h2>
        <div class="infoPers">
            <div class="hk-form">
                <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/user/edit'?>">
                    <input class="box" type="text" placeholder="Nom" size="30" name="firstName"><br/>
                    <input class="box" type="text" placeholder="Prénom" size="30" name="lastName"><br/>
                    <input class="btn" type="submit" value="Valider">
                </form>
            </div>
        </div>
        <br>
        <br>
        <h2 id="mailTitle">Editer mon email <i class="fa fa-chevron-down" id="email" aria-hidden="true"></i></h2>
        <div class="mail">
            <div class="hk-form">
                <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/user/edit'?>">
                    <input class="box" type="password" placeholder=" Mot de passe" size="30" name="password"><br/>
                    <input class="box" type="email" placeholder="Adresse mail actuelle" size="30" name="newEmail"><br/>
                    <input class="box" type="email" placeholder="Nouvelle adresse email" size="30" name="confirmNewEmail"><br/>
                    <input class="btn" type="submit" value="Valider">
                </form>
            </div>
        </div>
        <br>
        <br>
        <h2 id="mdpTitle">Editer mon mot de passe <i class="fa fa-chevron-down" aria-hidden="true"></i></h2>
        <div class="mdp">
            <div class="hk-form">
                <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/user/edit'?>">
                    <input class="box" type="password" placeholder="Ancien mot de passe" size="30" name="oldPassword"><br/>
                    <input class="box" type="password" placeholder="Nouveau mot de passe" size="30" name="newPassword"><br/>
                    <input class="box" type="password" placeholder="Saisir à nouveau le mot de passe" size="30" name="confirmNewPassword"><br/>
                    <input class="btn" type="submit" value="Valider">
                </form>
            </div>
        </div>
</div>
</body>
</html>