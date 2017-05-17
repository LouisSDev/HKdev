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

    <style>

        .bar{
            fill: steelblue;
        }

        .bar:hover{
            fill: brown;
        }

        .axis {
            font: 10px sans-serif;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
        }

    </style>

</head>
<body>
<?php
/** @var $user User */
$user = $GLOBALS['view']['user'] ;
include_once($GLOBALS['root_dir'] . '/view/general/header.php') ?>
<h1>TABLEAU DE BORD</h1>
    <h3>Bonjour <?php echo $user -> getFirstName()?></h3>

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
                <h3 class="chart-title chart-title4"></h3>
                <p class="chart-description chart-description4"></p>
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
    <div class="test"></div>
</body>
</html>
