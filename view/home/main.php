<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $GLOBALS['view']['page_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/user/myHome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/86ed160d29.js"></script>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/general.js"></script>

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
            echo '<div class="bedroom my-rooms">';
            foreach ($home ->getRoomsPerType("Chambres") as $room){
                echo '<div id="room'.$room->getId().'" class="circle click-bedroom click-room" roomId="' . $room -> getId() . '" style="background-color:#FFBC42"><p class="title">'.$room->getName().'</p>';
                echo '</div>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
            }

            echo '</div>';
        }
        if($home ->getRoomsPerType("Cuisines")!=null){
            echo '<i class="fa fa-cutlery iconKitchen" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="kitchen my-rooms">';
            foreach ($home ->getRoomsPerType("Cuisines") as $room){
                echo '<div id="room'.$room->getId().'" class="circle click-kitchen click-room" roomId="' . $room -> getId() . '"  style="background-color:#FB3640"><p class="title">'.$room->getName().'</p>';
                echo '</div>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
            }
            echo '</div>';
        }
        if($home ->getRoomsPerType("Salles d'eau")!=null){
            echo '<i class="fa fa-bath iconBath" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="bath my-rooms">';
            foreach ($home ->getRoomsPerType("Salles d'eau") as $room){
                echo '<div id="room'.$room->getId().'" class="circle click-bath click-room"  roomId="' . $room -> getId() . '" style="background-color:#8ca4b7"><p class="title">'.$room->getName().'</p>';
                echo '</div>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
            }
            echo '</div>';
        }
        if($home ->getRoomsPerType("Pièces à vivre")!=null){
            echo '<i class="fa fa-television iconSofa" aria-hidden="true" style="cursor:pointer;"></i>';
            echo '<div class="living my-rooms">';
            foreach ($home ->getRoomsPerType("Pièces à vivre") as $room){
                echo '<div id="room'.$room->getId().'" class="circle click-living click-room" style="background-color:#F2F3AE"><p class="title">'.$room->getName().'</p>';
                echo '</div>';
                echo '<div class="effectorsContainer room'.$room->getId().'">';
                displayEffectors($room);
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>