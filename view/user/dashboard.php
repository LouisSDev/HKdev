<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Editer mon profil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/modal.css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['server_root']?>/ressources/css/chart.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/chart/chart.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/pop-up.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;
include_once($GLOBALS['root_dir'] . '/view/general/header.php') ?>
<h1>TABLEAU DE BORD</h1>
    <h3>Bonjour <?php echo $user -> getFirstName()?></h3>

    <form>
        <p>Date de début: <input type="text" id="fromDate"></p>
        <p>Date de fin: <input type="text" id="toDate"></p>
        <input id="roomId" type="text" placeholder="Id de la pièce"/>
        <input id="homeId" type="text" placeholder="Id de la maison"/>
    </form>
    <button id="searchCharts">Afficher les statistiques!</button>

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
</body>
</html>
