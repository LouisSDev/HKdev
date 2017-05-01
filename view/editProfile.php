<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Password Change</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/connection.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">

</head>
<body>
        <div class="edit_password">

            <h1>Change Password</h1>
            <form method="POST" action="<?php echo $GLOBALS['server_root'] . '/resetPass'?>">
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
                <p><input type="submit" value="Update Password">
            </form>

            <p> <a href="passwordForgotten.php">Forgotten Password </a>
            <p><a href="dashbord.php">Dashbord</a>
            <p><a href="logout.php">Logout</a>


        </div>
        <div class="edit_email">


        </div>



</body>
</html>