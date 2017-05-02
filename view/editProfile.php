<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">

</head>
<body>
    <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/updateEmail'?>">
        <h1>Modifier mon adresse mail</h1>
        <input class="box" type="password" placeholder="Ancien mot de passe" size="30" name="password"><br/>
        <input class="box" type="email" placeholder="Adresse mail actuelle" size="30" name="currentEmailAddress"><br/>
        <input class="box" type="email" placeholder="Nouvelle adresse email" size="30" name="confirmNewEmail"><br/>
        <input class="btn" type="submit" value="Modifier mon adresse mail">
    </form>

    <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/updatePass'?>">
        <h1>Modifier mon mot de passe</h1>
        <input class="box" type="password" placeholder="Ancien mot de passe" size="30" name="oldPassword"><br/>
        <input class="box" type="password" placeholder="Nouveau mot de passe" size="30" name="newPassword"><br/>
        <input class="box" type="password" placeholder="Saisir à nouveau le mot de passe" size="30" name="confirmNewPassword"><br/>
        <input class="btn" type="submit" value="Update Password">
    </form>

    <p><?php echo ($GLOBALS['error'])?></p>
        <a href="dashboard.php">Dashbord</a>
        <a href="logout.php">Logout</a>
</body>
</html>