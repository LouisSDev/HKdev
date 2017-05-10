<header class="header">
    <?php
        if(isset($GLOBALS['user'])){
           ?>
            <nav class="menu">
                <a href="<?php echo $GLOBALS['server_root'] . '/user/home/general/'?>">Ma maison</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/user/dashboard/'?>">Tableau de bord</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/user/editProfile/'?>">Mon compte</a>
                <a href="<?php echo $GLOBALS['server_root'] . '/contact/'?>">Contact</a>
                <a href="#">Déconnexion</a>
            </nav>
    <?php
        }
        else{
     ?>
    <nav class="menu">
        <a href="<?php echo $GLOBALS['server_root'] . '/user/home/'?>">Accueil</a>
        <a href="<?php echo $GLOBALS['server_root'] . '/contact/'?>">Contact</a>
        <a id="show" href="#">Connexion</a>
    </nav>
    <?php
    }
    ?>
    <script src="<?php echo $GLOBALS['server_root']?>/ressources/js/currentElementHeader.js"></script>
</header>