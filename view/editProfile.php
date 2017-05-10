<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">

</head>
<body>

    <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/user/editEmail'?>">
        <h1>Modifier mon adresse mail</h1>
        <input class="box" type="email" placeholder="Nouvelle adresse mail" size="30" name="newEmail" required=""><br/>
        <input class="box" type="email" placeholder="Confirmer adresse mail" size="30" name="confirmNewEmail" required=""><br/>
        <input class="btn" type="submit" value="Modifier mon adresse mail">
    </form>

    <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/user/editPass'?>">
        <h1>Modifier mon mot de passe</h1>
        <input class="box" type="password" placeholder="Ancien mots de passe" size="30" name="oldPassword" required=""><br/>
        <input class="box" type="password" placeholder="Nouveau mots de passe" size="30" name="newPassword" required=""><br/>
        <input class="box" type="password" placeholder="Confirmer mots de passe" size="30" name="confirmNewPassword" required=""><br/>
        <input class="btn" type="submit" value="Modifier mots de passe">
    </form>

    <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/user/editInfo'?>">
        <h1>Editer mes infos personnelles</h1>
        <input class="box" type="password" placeholder="Nom" size="30" name="nom" required=""><br/>
        <input class="box" type="password" placeholder="Prénom" size="30" name="prénom" required=""><br/>
        <input class="btn" type="submit" value="Modifier mes informations">
    </form>

        <a href="dashboard.php">Dashbord</a>
        <a href="logout.php">Logout</a>
</body>
</html>