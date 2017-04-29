<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Password Change</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">

</head>
<body>
<h1>Change Password</h1>
<form method="POST" action="<?php echo $GLOBALS['server_root'] . '/resetPass'?>">
    <table>
        <tr>
            <td><input type="password" placeholder="Old password" size="30" name="OldPassword"></td>
        </tr>
        <tr>
            <td><input type="password" placeholder="New password" size="30" name="newpassword"></td>
        </tr>
        <tr>
            <td><input type="password" placeholder="Re-enter your new password" size="30" name="confirmnewpassword"></td>
        </tr>
    </table>
    <p><input type="submit" value="Update Password">
</form>

<?php echo("Sorry the two password don't match") ?>

    <p> <a href="passwordForgotten.php">Forgotten Password </a>

    <p><a href="dashbord.php">Dashbord</a>
    <p><a href="logout.php">Logout</a>
</body>
</html>