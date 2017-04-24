<h1>Vous êtes intéressé ?</h1>
<h1>Demander un devis !</h1>
<form action="tag-html-balise-form" method="get" enctype="multipart/form-data">
    <p>
        <input class=box type="text" name="First Name" placeholder="Nom"/><br>
        <input class=box type="text" name="Last Name" placeholder="Prénom"/><br>
        <input class=box type="text" name="Address" placeholder="Adresse"/><br>
        <input class=box type="text" name="City" placeholder="Ville"/><br>
        <input class=box type="text" name="Mail" placeholder="Adresse mail"/><br>
        <input type="file" name="MyFile" /><br />
        <input class="btn" type="submit" value="Envoyer" />
    </p>
</form>

<?php
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['MyFile']) AND $_FILES['MyFile']['error'] == 0)
{
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['MyFile']['size'] <= 1000000)
    {
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['MyFile']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($extension_upload, $extensions_autorisees))
        {
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['MyFile']['tmp_name'], 'uploads/' . basename($_FILES['MyFile']['name']));
            echo "L'envoi a bien été effectué !";
        }
    }
}
?>