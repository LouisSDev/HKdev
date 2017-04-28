<form action="<?php echo $GLOBALS['server_root'] ?>/signup" method="post" enctype="multipart/form-data">
        <input class=box type="text" name="firstName" placeholder="Nom"/><br/>
        <input class=box type="text" name="lastName" placeholder="Prénom"/><br/>
        <input class=box type="text" name="country" placeholder="Pays"/><br/>
        <input class=box type="text" name="city" placeholder="Ville"/><br/>
        <input class=box type="text" name="address" placeholder="Adresse"/><br/>
        <input class=box type="text" name="mail" placeholder="Adresse mail"/><br/>
        <input class=box type="text" name="cellPhoneNumber" placeholder="Numéro de téléphone"/><br/>
        <input class=box type="text" name="password" placeholder="Mot de passe"/><br/>
        <input class=box type="text" name="passwordRepeat" placeholder="Répétez votre mot de passe"/><br/>
        <input type="file" name="file" /><br/>
        <input class="btn" type="submit" value="Envoyer" />
</form>
