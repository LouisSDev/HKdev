<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profile</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">

</head>
<body>
    <form  class="box" method="POST" action="<?php echo $GLOBALS['server_root'] . '/updateInfos'?>">
        <h1>Edditer Mes informations personnelles</h1>
        <table>
            <tr>
                <td><input type="password" placeholder=" Ancien numéro" size="30" name="oldNumber"></td>
            </tr>
            <tr>
                <td><input type="email" placeholder="Nouveau numero" size="30" name="currentEmailAddress"></td>
            </tr>
        </table>
        <p><input class="btn" type="submit" value="Modifier mon email">
    </form>

    <form  class="box" method="POST" action="<?php echo $GLOBALS['server_root'] . '/updateEmail'?>">
        <h1>Edditer l'adresse mail</h1>
        <table>
            <tr>
                <td><input type="password" placeholder="Old password" size="30" name="password"></td>
            </tr>
            <tr>
                <td><input type="email" placeholder="Adresse mail actuel" size="30" name="currentEmailAddress"></td>
            </tr>
            <tr>
                <td><input class="box" type="email" placeholder="Confirmer votre nouvelle adresse email" size="30" name="confirmNewEmail"></td>
            </tr>
        </table>
        <p><input class="btn" type="submit" value="Modifier mon email">

    </form>

    <form   class="box" method="POST" action="<?php echo $GLOBALS['server_root'] . '/upadatePass'?>">
        <h1>Editer le mot de passe</h1>
        <table>
            <tr>
                <td><input type="password" placeholder="Old password" size="30" name="oldPassword"></td>
            </tr>
            <tr>
                <td><input type="password" placeholder="New password" size="30" name="newPassword"></td>
            </tr>
            <tr>
                <td><input type="password" placeholder="Re-enter your new password" size="30" name="confirmNewPassword"></td>
            </tr>
        </table>
        <p><input class="btn" type="submit" value="Update Password">

    </form>

    <p> <?php echo ($GLOBALS['error'])?></p>

        <a href="passwordForgotten.php">Forgotten Password </a>
        <a href="dashbord.php">Dashbord</a>
        <a href="logout.php">Logout</a>
</body>
</html>