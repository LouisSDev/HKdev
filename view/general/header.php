<header class="header">
    <?php
        if(isset($GLOBALS['view']['connected']) && $GLOBALS['view']['connected']){
           ?>
            <nav class="menu">
                <ul>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/home'?>">Ma maison</a></li>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/dashboard'?>">Tableau de bord</a></li>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/edit'?>">Mon compte</a></li>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/contact'?>">Contact</a></li>
                    <li><a href="<?php echo $GLOBALS['server_root'] . '/user/disconnect'?>">Déconnexion</a></li>
                    <!--TODO : Implement submenu-->
                </ul>
            </nav>
    <?php
        }
        else{
     ?>
    <nav class="menu">
        <ul>
            <li><a href="<?php echo $GLOBALS['server_root']?>/">Accueil</a>
                <ul class="submenu">
<!-- TODO : This is an example of submenu, need to replace it by reals things XD -->
                    <li><a href="#">Exemple 1</a></li>
                    <li><a href="#">Exemple 2</a></li>
                    <li><a href="#">Exemple 3</a></li>
                </ul>
            </li>
            <li><a href="<?php echo $GLOBALS['server_root'] . '/contact'?>">Contact</a></li>
            <li><a id="show" href="#">Connexion</a></li>
        </ul>
    </nav>
    <?php
    }
    ?>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/currentElementHeader.js"></script>
</header>
