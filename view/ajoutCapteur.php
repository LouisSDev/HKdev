<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ajoutCapteur</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">
</head>
<body>
    <ins>
        Home Kepper
            28, rue Notre-Dame des Champs
            75006 Paris
    </ins>
    <div><form>
        <p class="text">Ajouter des capteurs </p>
        <label>Sélectionnez votre capteur :</label><br>
        <select>
            <option label="" value="">Température</option>
            <option>Humidité</option>
            <option>Présence</option>
        </select><br>
        <label>Quantité</label><br>
        <input type="number" step="1" value="1" min="0" max="20"><br>

        <label>Sélectionnez la pièces ou vous souhaitez ajouter les capteurs :</label><br>
        <select multiple>
            <option selected label="aucune" value="">Aucune</option>
            <optgroup label="Rez de chaussé">
                <option value="">Cuisine</option>
                <option value="">Sallon</option>
                <option value="">Bureau</option>
            </optgroup>
            <optgroup label="1e Etage">
                <option value="">Chambre enfant 1</option>
                <option value="">Chambre des parents</option>
                <option value="">Salle de Bain </option>
            </optgroup>
            <optgroup label="2e Etage">
                <option value="">Salle de Jeu</option>
            </optgroup>
        </select> <br>

        <input class="btn" type="submit" value="Envoyer" />
        <p class="text">Nous vous contacterons dans la semaine qui suit cet envoie</p>
        </form></div>


</body>
</html>