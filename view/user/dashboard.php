<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['server_root']?>/ressources/css/chart.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/dashboard.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/chart/chart.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>
</head>
<body>
<br>
<br>
<br>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;

$homes = $user -> getHomes();

$rooms = $user -> getAllRooms();

include_once($GLOBALS['root_dir'] . '/view/general/header.php') ?>


<br><br><br>
    <div class="hello information-message">Bonjour <?php echo $user -> getFirstName() ?>
        <br>
        Avez-vous passé une bonne journée?
        <br>
        Nous nous occupons de tout pour vous pendant votre absence!
        <br>
        Voici un petit résumé de vos consommations récentes.
    </div>
    <div class="error"></div>

    <form class="drop" method="post" action="<?php echo $GLOBALS['server_root']?>/api/get/sensors/values">
        <label>Date de début: <br><input type="text" id="fromDate"></label></br>
        <label>Date de fin: <br><input type="text" id="toDate"></label>
        <select id="homeId" class="homes">
            <option label = "" value = "-1">Statistiques générales de mes maisons</option>

            <?php

            /**
             * @var Home $home
             */
            foreach ($homes as $home){

                if(!$home->getHasHomes()){

                    echo '<option label="" value="' . $home ->getId() . '" >'
                        . $home -> getName() . ' - ' . $home -> getBuilding() -> getName()
                        .'</option>';
                }
            }
            ?>
        </select><br>
        <select id="roomId">
            <option label = "" value = "-1">Statistiques générales de mes pièces</option>
            <?php
            foreach (Room::TYPE_ARRAY as $type){

                echo '<optgroup label="'. $type .'">';

                /** @var Room $room */
                foreach ($rooms as $room){
                    if ($room -> getType() === $type ) {
                        echo '<option class="roomSelector" homeId="' . $room -> getHome() -> getId()
                        . '" label="" value="' . $room -> getId() .'">'
                            . $room -> getName() . '</option>';
                    }
                }
                echo '</optgroup>';
            }
            ?>
        </select>
    </form>

    <button class="btn" id="searchCharts">Afficher les statistiques!</button>


    <table>
        <tr>
            <td>
                <h3 class="chart-title chart-title1"></h3>
                <p class="chart-description chart-description1"></p>
                <graph1 class = "graph graph-1"></graph1>
            </td>
            <td>
                <h3 class="chart-title chart-title2"></h3>
                <p class="chart-description chart-description2"></p>
                <graph2 class = "graph graph-2"></graph2>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <h3 class="chart-title chart-title3"></h3>
                <p class="chart-description chart-description3"></p>
                <graph3 class = "graph graph-3"></graph3>
            </td>
            <td>
                <br>
                <h3 class="chart-title chart-title4"></h3>
                <p class="chart-description chart-description4"></p>
                <graph4 class = "graph graph-4"></graph4>
            </td>
        </tr>
    </table>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
</body>
</html>
