<?php @session_start();?>
<div class="eventkarte-route-location">
    <input class="eventkarte-location" placeholder="Ort" />
    <a onclick="removeRouteSegment(this);" class="eventkarte-route-minus">
        <img alt="Auto" title="Auto" src="./icons/delete.png" />
    </a>
    <input class="eventkarte-time" placeholder="Zeit"/>
</div>
<div class="eventkarte-route-type">
    <a onclick="addRouteSegment(this);" class="eventkarte-route-plus">
        <img alt="Auto" title="Auto" src="./icons/plus.png" />
    </a>
    <div class="eventkarte-route-types">
        <a onclick="choseType(this);" data-value="0" class="selected">
            <img alt="Auto" title="Auto" src="./icons/car.png" />
        </a>
        <a onclick="choseType(this);" data-value="1">
            <img alt="Zug" title="Zug" src="./icons/train.png" />
        </a>
        <a onclick="choseType(this);" data-value="2">
            <img alt="Schiff" title="Schiff" src="./icons/ship.png" />
        </a>
        <a onclick="choseType(this);" data-value="3">
            <img alt="Bus" title="Bus" src="./icons/bus.png" />
        </a>
        <a onclick="choseType(this);" data-value="4">
            <img alt="Fahrrad" title="Fahrrad" src="./icons/bicycle.png" />
        </a>
        <a onclick="choseType(this);" data-value="5">
            <img alt="Flugzeug" title="Flugzeug" src="./icons/aeroplane.png" />
        </a>
    </div>
    <input class="eventkarte-free-seats" placeholder="freie Plätze" type="number" min="0" max="99"  />
</div>
