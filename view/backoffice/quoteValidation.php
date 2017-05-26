<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Capteurs et les Effecteurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/quoteValidation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/form.css">

</head>

<body>
<?php

include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");

$admin = $GLOBALS['view']['user'];

$quoteTreatedUsers = $GLOBALS['view']['quoteTreatedUsers'];
$quoteSubmittedUsers = $GLOBALS['view']['quoteSubmittedUsers'];


include_once($GLOBALS['root_dir'] . '/view/general/error.php');

?>

<h1>Consultez les demandes de devis et marquez les ici comme étant en cours de traitement</h1>
<h2>Devis soumis : </h2>
<table class="user-display">
    <tr class="user-display-column">
        <th class="user-display-cell title-cell">Prénom</th>
        <th class="user-display-cell title-cell">Nom</th>
        <th class="user-display-cell title-cell">Mail</th>
        <th class="user-display-cell title-cell">Numéro de téléphone</th>
        <th class="user-display-cell title-cell">Détail de la demande</th>
    </tr>
    <?php


    /** @var  $quote User*/
    foreach ($quoteSubmittedUsers as $quote) {
        echo '<tr class="user-display-column">';

        echo  '<td class="user-display-cell">' . $quote -> getFirstName() . '</td class="user-display-cell">'
            . '<td class="user-display-cell">' . $quote -> getLastName() . '</th>'
            . '<td class="user-display-cell">' . $quote -> getMail() . '</th>'
            . '<td class="user-display-cell">' . $quote -> getCellPhoneNumber() . '</th>'
            . '<td class="user-display-cell"><a href="'. $GLOBALS['server_root'] . '/' . $quote -> getQuoteFilePath() . '" target="_blank">Devis</a></th>';

        echo '</tr>';
    }
    ?>

</table>

<form method="post" class="hk-form">
    <label class="hk-text"> Sélectionnez le devis :</label><br>
    <select name="treatedUserId">
        <?php


        /** @var  $quote User*/
        foreach ($quoteSubmittedUsers as $quote) {

            echo '<option label="" value="'
                . $quote -> getId() . '">'
                . $quote -> getFirstName() . ' '
                . $quote -> getLastName()
                . '</option>';

        }
        ?>
    </select><br>

    <input class="btn" type="submit" value="Marquer comme en cours de traitement" />
</form>


<p class="hk-title">Consultez les utilisateurs dont la demande a été prise en charge puis supprimez leur compte ou validez le</p>
<p class="hk-title">Devis soumis : </p>
<table class="user-display">
    <tr class="user-display-column">
        <th class="user-display-cell title-cell">Prénom</th>
        <th class="user-display-cell title-cell">Nom</th>
        <th class="user-display-cell title-cell">Mail</th>
        <th class="user-display-cell title-cell">Numéro de téléphone</th>
        <th class="user-display-cell title-cell">Détail de la demande</th>
    </tr>
    <?php


    /** @var  $quote User*/
    foreach ($quoteTreatedUsers as $quote) {
        echo '<tr class="user-display-column">';

        echo  '<td class="user-display-cell">' . $quote -> getFirstName() . '</td class="user-display-cell">'
            . '<td class="user-display-cell">' . $quote -> getLastName() . '</th>'
            . '<td class="user-display-cell">' . $quote -> getMail() . '</th>'
            . '<td class="user-display-cell">' . $quote -> getCellPhoneNumber() . '</th>'
            . '<td class="user-display-cell"><a href="'. $GLOBALS['server_root'] . '/' . $quote -> getQuoteFilePath() . '" target="_blank">Devis</a></th>';

        echo '</tr>';
    }
    ?>
</table>
    <form method="post" class="hk-form">
        <label class="hk-text"> Sélectionnez le devis à valider:</label><br>
        <select name="validatedUserId">
            <?php


            /** @var  $quote User*/
            foreach ($quoteTreatedUsers as $quote) {

                echo '<option label="" value="'
                    . $quote -> getId() . '">'
                    . $quote -> getFirstName() . ' '
                    . $quote -> getLastName()
                    . '</option>';

            }
            ?>
        </select><br>

        <input class="btn" type="submit" value="Valider cet utilisateur" />
    </form>

    <form method="post" class="hk-form">
        <label class="hk-text"> Sélectionnez le devis à supprimer:</label><br>
        <select name="deletedUserId">
            <?php


            /** @var  $quote User*/
            foreach ($quoteTreatedUsers as $quote) {

                echo '<option label="" value="'
                    . $quote -> getId() . '">'
                    . $quote -> getFirstName() . ' '
                    . $quote -> getLastName()
                    . '</option>';

            }
            ?>
        </select><br>

        <input class="btn" type="submit" value="Supprimer cet utilisateur" />
</body>
</html>