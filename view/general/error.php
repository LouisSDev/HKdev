
<div class="error">
    <?php
    if(isset ($GLOBALS['view']['error_block'],
                $GLOBALS['view']['success_message'])
        || isset ($GLOBALS['view']['error_block'],
            $GLOBALS['view']['error_message'])){
        echo '<div class="hk-block hk-block-margin">';
    }

        if(isset ($GLOBALS['view']['success_message'])){ ?>
            <div class="success-message information-message">
                <?php echo $GLOBALS['view']['success_message'] ?>
            </div>
            <?php
        }
        elseif( isset($GLOBALS['view']['error_message'])) { ?>
            <div class="error-message information-message">
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
    if(isset ($GLOBALS['view']['error_block'],
            $GLOBALS['view']['success_message'])
        || isset ($GLOBALS['view']['error_block'],
            $GLOBALS['view']['error_message'])){
            echo '</div>';
    }
    ?>
</div>
