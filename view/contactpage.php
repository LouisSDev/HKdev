<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/contactpage.css">
</head>
<body>
<?php include_once("header.php");?>
<div class="address">
    <p>
        Home Kepper
    </p>
    <p>
        28, rue Notre-Dame des Champs
    </p>
    <p>
        75006 Paris
    </p>
</div>
<div class="form">
    <form action="tag-html-balise-form" method="get" enctype="multipart/form-data">
        <input class=box type="text" name="First Name" placeholder="Nom"/><br>
        <input class=box type="text" name="Last Name" placeholder="Prénom"/><br>
        <input class=box type="text" name="tel" placeholder="Téléphone"/><br>
        <input class=box type="text" name="Mail" placeholder="Adresse mail"/><br>
        <input class=box type="text" name="Subject" placeholder="Sujet"/><br>
        <input class=block type="textarea" name="Message" placeholder="Message"/><br>
        <input type="file" name="MyFile" /><br />
        <input class="btn" type="submit" value="Envoyer" />
    </form>
</div>
</body>
</html>

