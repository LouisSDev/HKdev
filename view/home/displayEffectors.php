<?php

function displayEffectors(Room $room){
    $effectorsType = $room ->getAllEffectorsTypeInRoom();


    if($effectorsType) {
        /** @var EffectorType $effectorType */
        foreach ($effectorsType as $effectorType) {
            if ($effectorType->getType() === "Climatisation") {
                /** @var Effector $clim */
                $clim = $room->getEffectorsPerType("Climatisation")[0];
                $climValue = $clim->getValue();

                echo '<div class="effectors-input temp effectors-' . $room->getId() . '">
            
                    <input class="value" value="' . $climValue
                    . '" type="number" step="1" value="15" min="0" max="25" id="clim-eff-val-' . $room->getId() . '">
                
                    <p class="info">Température</p>
                    
                    <button id="temp-effector-' . $room->getId() . '" roomId="' . $room->getId()
                    . '" class ="save-clim-effector btn">
                
                        Sauvegarder
                    </button>    
                </div>';
            }
            if ($effectorType->getType() === "Volets") {

                /** @var Effector $shutter */
                $shutter = $room->getEffectorsPerType("Volets")[0];
                $shutterState = $shutter->getState();
                if ($shutterState) {
                    //Utils::addWarning($shutter -> getId() . ' ' . $shutter -> getName() . ' ' . $shutter -> getState());
                    $onClass = '';
                    $offClass = 'unactive-switch';
                } else {
                    $offClass = '';
                    $onClass = 'unactive-switch';
                }

                echo '<div class="effectors-input volets effectors-' . $room->getId() . '">
                    <i class="fa fa-toggle-off switch-off ' . $offClass . '" roomId="' . $room->getId()
                    . '" id="switch-off-' . $room->getId() . '" aria-hidden="true" style="cursor:pointer;"></i>
                
                    <i class="fa fa-toggle-on switch-on ' . $onClass . '" roomId="' . $room->getId()
                    . '" id="switch-on-' . $room->getId() . '"  aria-hidden="true" style="cursor:pointer;"></i>
                
                    <p class="info">Volets</p>
                    <input type = \'hidden\'  value="' . $shutterState . '" id="vol-eff-val-' . $room->getId() . '">
                    <button id="volet-effector-' . $room->getId() . '" roomId="' . $room->getId()
                    . '" class ="save-volet-effector btn">
                
                        Sauvegarder
                    </button>    
                </div>';
            }

            if ($effectorType->getType() === "Lumière") {

                /** @var Effector $light */
                $light = $room->getEffectorsPerType("Lumière")[0];
                $lightValue = $light->getValue();

                echo '<div class="effectors-input lum effectors-' . $room->getId() . '">
                    <input type="range" value="' . $lightValue . '" min="0" max="100" id="lum-eff-val-' . $room->getId() . '" />
                    <p class="info">Luminosité</p>
                    
                    <button id="lum-effector-' . $room->getId() . '" roomId="' . $room->getId()
                    . '" class ="save-lum-effector btn">
                
                        Sauvegarder
                    </button>    
                </div>';
            }
        }
    }
}