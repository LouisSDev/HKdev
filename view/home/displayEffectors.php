<?php

function displayEffectors(Room $room){
    $effectorsType = $room ->getAllEffectorsTypeInRoom();
    /** @var EffectorType $effectorType */
    foreach($effectorsType as $effectorType){
        if($effectorType->getType() === "Climatisation"){
            echo '<div class="effectors-input temp effectors-' . $room -> getId() . '">
                    <input class="value" type="number" step="1" value="15" min="0" max="25">
                    <p class="info">Température</p>
                    <button id="temp-effector-' . $room -> getId() . '" roomId="' . $room -> getId() . '" class ="save-temp-effector">
                        Sauvegarder
                    </button>    
                </div>';
        }
        if($effectorType ->getType() === "Volets"){
            echo '<div class="effectors-input volets effectors-' . $room -> getId() . '">
                    <i class="fa fa-toggle-off switch-off" roomId="' . $room -> getId() . '" id="switch-off-' . $room -> getId() . '" aria-hidden="true" style="cursor:pointer;"></i>
                    <i class="fa fa-toggle-on switch-on" roomId="' . $room -> getId() . '" id="switch-on-' . $room -> getId() . '"  aria-hidden="true" style="cursor:pointer;"></i>
                    <p class="info">Volets automatique</p>
                    <button id="volet-effector-' . $room -> getId() . '" roomId="' . $room -> getId() . '" class ="save-volet-effector">
                        Sauvegarder
                    </button>    
                </div>';
        }

        if($effectorType->getType() === "Lumière"){
            echo '<div class="effectors-input lum effectors-' . $room -> getId() . '">
                    <input type="range"  min="0" max="100" id="lum-eff-val-' . $room -> getId() . '" />
                    <p class="info">Luminosité</p>
                    <button id="lum-effector-' . $room -> getId() . '" roomId="' . $room -> getId() . '" class ="save-lum-effector">
                        Sauvegarder
                    </button>    
                </div>';
        }
    }
}