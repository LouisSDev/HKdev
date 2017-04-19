<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>

<body>
    <h1>Vous êtes intéressé ?</h1>
    <h1>Demander un devis !</h1>

    <form action="tag-html-balise-form" method="get" enctype="multipart/form-data">
        <p>
            <input type="text" name="Name" value="Nom"/><br>
            <input type="text" name="Prenom" value="Prénom"/><br>
            <input type="text" name="Adress" value="Adresse"/><br>
            <input type="text" name="Code Postal" value="Code Postal"/><br>
            <input type="text" name="City" value="Ville"/><br>
            <input type="text" name="Mail" value="Adresse mail"/><br>
            <input type="file" name="monfichier" /><br />
            <input class="btn" type="submit" value="Envoyer" />
        </p>
    </form>
    <?php
    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
    {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['monfichier']['size'] <= 1000000)
        {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['monfichier']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees))
            {
                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/' . basename($_FILES['monfichier']['name']));
                echo "L'envoi a bien été effectué !";
            }
        }
    }
    ?>
</body>
</html>