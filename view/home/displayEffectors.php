<?php

function displayEffectors(Room $room){
    $effectorsType[] = $room ->getAllEffectorsTypeInRoom();
    /** @var EffectorType $type */
    foreach($effectorsType as $type){
        if($type === "Température"){
            echo '<div class="temp">
    <input class="value" type="number" step="1" value="15" min="0" max="25">
    <p class="info">Température</p>
</div>';
        }
        if($type === "Volets"){
            echo '<div class="volets">
    <i class="fa fa-toggle-off" id="off" aria-hidden="true" style="cursor:pointer;"></i>
    <i class="fa fa-toggle-on" id="on" aria-hidden="true" style="cursor:pointer;"></i>
    <p class="info">Volets automatique</p>
</div>';
        }
        if($type === "Luminosité"){
            echo '<div class="lum">
    <input type="range"  min="0" max="100" />
    <p class="info">Luminosité</p>
</div>';
        }
    }
}