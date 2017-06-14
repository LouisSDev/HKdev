

<header class="header">
    <?php
        if(isset($GLOBALS['view']['connected']) && $GLOBALS['view']['connected']){
            /** @var User $user */
            $user = $GLOBALS['view']['user'];
            $allHomes = $user -> getHomes();

            $homes = [];
            $buildings = [];

            /** @var Home $home */
            foreach($allHomes as $home){
                if($home -> getBuilding()){
                    $homes[] = $home;
                }else{
                    $buildings[] = $home;
                }
            }
           ?>
            <nav class="menu">
                <ul>
                    <li class ="logo"><a href="<?php echo $GLOBALS['server_root']?>"><img class="logo" src="<?php echo $GLOBALS['server_root']?>/ressources/img/logo hk blanc_redim.png"></a></li>
                    <?php if($user -> getAdmin() ) {?>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/admin'?>">Back-Office</a></li>
                    <?php }?>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/dashboard'?>">Tableau de bord</a></li>
                    <?php if(count( $homes )) {

                        echo '<li><a href="#"> Mes Maisons' ;

                        echo '<ul class="submenu" >';

                        /** @var Home $home */
                        foreach ($homes as $home) {

                            echo '<li ><a href = "' . $GLOBALS['server_root'] . '/user/home/'
                                . $home->getId() . '/general" >' . $home->getName() . '</a ></li >';
                        }
                        echo '</ul></li>';

                        echo '<li><a href="#">Mes Capteurs' ;

                        echo '<ul class="submenu" >';

                        /** @var Home $home */
                        foreach ($homes as $home) {

                            echo '<li ><a href = "' . $GLOBALS['server_root'] . '/user/home/'
                                . $home->getId() . '/sensors" >' . $home->getName() . '</a ></li >';
                        }
                        echo '</ul></li>';
                    }
                    if(count( $buildings )) {
                        echo '<li><a href="#">Administrer mes immeubles';

                        echo '<ul class="submenu" >';

                        /** @var Home $building */
                        foreach ($buildings as $building) {

                            echo '<li ><a href = "' . $GLOBALS['server_root'] . '/user/home/'
                                . $building->getId() . '/administrate" >' . $building->getName() . '</a ></li >';
                        }
                        echo '</ul></li>';
                    } ?>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/edit'?>">Mon compte</a></li>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/disconnect'?>">Déconnexion</a></li>
                </ul>
            </nav>
    <?php
        }
        else{
     ?>
    <nav class="menu">
        <ul>
            <li><a href="<?php echo $GLOBALS['server_root']?>/"><img class="logo" src="<?php echo $GLOBALS['server_root']?>/ressources/img/logo hk blanc_redim.png"></a></li>
            <li><a href="<?php echo $GLOBALS['server_root']?>/">Accueil</a></li>
            <li><a id="show" href="#">Connexion</a></li>
        </ul>
    </nav>
    <?php
    }
    ?>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/general.js"></script>
</header>
