<header class="header">
    <?php
        if(isset($GLOBALS['view']['connected']) && $GLOBALS['view']['connected']){
           ?>
            <nav class="menu">
                <a href="<?php echo $GLOBALS['server_root'] . '/user/dashboard'?>">Tableau de bord</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/user/home'// TODO : not the right path, please check the rooting.php or ask to the AWESOME Louis (also known as "THE VERY BEST", "King of the universe", "the Motherfucker") for more information. Also add other described  pages in this header ?>">Ma maison</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/user/edit'?>">Editer Mon Profil</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/contact'?>">Contact</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/user/disconnect'?>">Déconnexion</a>
            </nav>
    <?php
        }
        else{
     ?>
    <nav class="menu">
        <a href="<?php echo $GLOBALS['server_root']?>/">Accueil</a>
        <a href="<?php echo $GLOBALS['server_root'] . '/contact'?>">Contact</a>
        <a id="show" href="#">Connexion</a>
    </nav>
    <?php
    }
    ?>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/currentElementHeader.js"></script>
</header>
