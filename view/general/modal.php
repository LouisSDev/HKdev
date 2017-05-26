<div id="modal">
    <i class="fa fa-times-circle fa-lg close" aria-hidden="true"></i>
    <div class="hk-form hk-form-centered">
        <form method="post" action="<?php echo $GLOBALS['server_root'] . '/user/dashboard'?>">
            <input type="email" name="userMail" placeholder="Adresse mail">
            <input type="password" name="userPassword" placeholder="Mot de passe">
            <input class="button" type="submit" value="Envoyer" />
        </form>
        <div class="link">
            <a href="<?php echo $GLOBALS['server_root']?>\lol" target="_self">Mot de passe oublié ?</a>
        </div>
    </div>
</div>