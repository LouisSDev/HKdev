<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/myHome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/myHome.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/auto.js"></script>

</head>
<body>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/header.php");?>
<?php include ($GLOBALS['root_dir']."/view/home/displayEffectors.php")?>

    <div class="home">
        <i class="fa fa-home iconHome" aria-hidden="true" style="cursor:pointer;"></i>
    </div>

<?php
/** @var Home $home */
$home = $GLOBALS['view']['home'];
/** @var Room $room */
?>
    <div class="rooms">
        <?php
        if($home ->getRoomsPerType("Chambres")!=null){
            echo '<i class="fa fa-bed iconBed" id="bed" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="bedroom">';
            foreach ($home ->getRoomsPerType("Chambres") as $room){
                echo '<div id="room'.$room->getId().'" class="circle" style="background-color:#FFBC42"><p class="title">'.$room->getName().'</p>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        }
        if($home ->getRoomsPerType("Cuisines")!=null){
            echo '<i class="fa fa-cutlery iconKitchen" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="kitchen">';
            foreach ($home ->getRoomsPerType("Cuisines") as $room){
                echo '<div id="room'.$room->getId().'" class="circle"  style="background-color:#FB3640"><p class="title">'.$room->getName().'</p>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        if($home ->getRoomsPerType("Salles d'eau")!=null){
            echo '<i class="fa fa-bath iconBath" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="bath">';
            foreach ($home ->getRoomsPerType("Salles d'eau") as $room){
                echo '<div id="room'.$room->getId().'" class="circle" style="background-color:#BFDBF7"><p class="title">'.$room->getName().'</p>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        if($home ->getRoomsPerType("Pièces à vivre")!=null){
            echo '<i class="fa fa-television iconSofa" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="living">';
            foreach ($home ->getRoomsPerType("Pièces à vivre") as $room){
                echo '<div id="room'.$room->getId().'" class="circle" style="background-color:#F2F3AE"><p class="title">'.$room->getName().'</p>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>