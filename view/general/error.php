<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['server_root']?>/ressources/css/global.css">
<div class="error">
    <?php

        if(isset ($GLOBALS['view']['success_message'])){ ?>
            <div class="success-message">
                <?php echo $GLOBALS['view']['success_message'] ?>
            </div>
            <?php
        }
        elseif( isset($GLOBALS['view']['error_message'])) { ?>
            <div class="error-message">
                <?php
                    echo $GLOBALS['view']['error_message']  ;
                    if( isset($GLOBALS['view']['errors'])) {
                ?>
                <div class="error-details">
                     <?php
                        foreach ($GLOBALS['view']['errors'] as $err){
                            echo '<p>' . $err . '</p></br>';
                        }
                     ?>
                </div>
                <?php }?>
            </div>
            <?php
        }
    ?>
</div>