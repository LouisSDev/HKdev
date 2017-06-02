<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gérer les Capteurs et les Effecteurs</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/general/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/admin/quoteValidation.css">

    </head>

    <body>
    <?php

    include_once ($GLOBALS['root_dir'] . "/view/general/adminHeader.php");

    $admin = $GLOBALS['view']['user'];

    $quoteTreatedUsers = $GLOBALS['view']['quoteTreatedUsers'];
    $quoteSubmittedUsers = $GLOBALS['view']['quoteSubmittedUsers'];


    include_once($GLOBALS['root_dir'] . '/view/general/error.php');

    ?>
    <div class="container">
        <h1 class="hk-title">Consultez les demandes de devis et marquez les ici comme étant en cours de traitement </h1>
        <div classe="new-devis">
            <h2 class="hk-title-2">Devis soumis : </h2>
            <table class="table">
                <tr class="user-display-column">
                    <th class="title-cell">Prénom</th>
                    <th class="title-cell">Nom</th>
                    <th class="title-cell">Mail</th>
                    <th class="title-cell">Numéro de téléphone</th>
                    <th class="title-cell">Détail de la demande</th>
                </tr>
                <?php


                /** @var  $quote User*/
                foreach ($quoteSubmittedUsers as $quote) {
                    echo '<tr class="user-display-column">';

                    echo  '<td class="cell">' . $quote -> getFirstName() . '</td class="cell">'
                        . '<td class="cell">' . $quote -> getLastName() . '</th>'
                        . '<td class="cell">' . $quote -> getMail() . '</th>'
                        . '<td class="cell">' . $quote -> getCellPhoneNumber() . '</th>'
                        . '<td class="cell"><a href="'. $GLOBALS['server_root'] . '/' . $quote -> getQuoteFilePath() . '" target="_blank">Devis</a></th>';

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
        </div>

        <h1 class="hk-title">Consultez les utilisateurs dont la demande a été prise en charge puis supprimez leur compte ou validez le Devis soumis :</h1>
            <div class="user-devis">
                <table class="table">
                    <tr class="user-display-column">
                        <th class="title-cell">Prénom</th>
                        <th class="title-cell">Nom</th>
                        <th class="title-cell">Mail</th>
                        <th class="title-cell">Numéro de téléphone</th>
                        <th class="title-cell">Détail de la demande</th>
                    </tr>
                    <?php


                    /** @var  $quote User*/
                    foreach ($quoteTreatedUsers as $quote) {
                        echo '<tr class="user-display-column">';

                        echo  '<td class="cell">' . $quote -> getFirstName() . '</td class="cell">'
                            . '<td class="cell">' . $quote -> getLastName() . '</th>'
                            . '<td class="cell">' . $quote -> getMail() . '</th>'
                            . '<td class="cell">' . $quote -> getCellPhoneNumber() . '</th>'
                            . '<td class="cell"><a href="'. $GLOBALS['server_root'] . '/' . $quote -> getQuoteFilePath() . '" target="_blank">Devis</a></th>';

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
                    </form>
            </div>
        </div>
    </body>

</html>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>