<div id="modal">
    <i class="fa fa-times-circle fa-lg close" aria-hidden="true"></i>
    <div class="form">
        <form method="post" action="<?php echo $GLOBALS['server_root'] . '/connect'?>">
            <input type="email" name="mail" placeholder="Adresse mail">
            <input type="password" name="password" placeholder="Mot de passe">
            <input class="button" type="submit" value="Envoyer" />
        </form>
        <div class="link">
            <a href="<?php echo $GLOBALS['server_root']?>\lol" target="_self">Mot de passe oublié ?</a>
        </div>
    </div>
</div>