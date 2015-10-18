<?php @session_start();?>
<div class="eventkarte-route-location">
	<input class="eventkarte-location" placeholder="Ort" />
	<a onclick="removeRouteSegment(this);" class="eventkarte-route-minus">✘</a>
	<input class="eventkarte-time" placeholder="Zeit"/>
</div>
<div class="eventkarte-route-type">
	<a onclick="addRouteSegment(this);" class="eventkarte-route-plus">+</a>
	<div class="eventkarte-route-types">
		<a onclick="choseType(this);" data-value="0" class="selected">
			<img alt="Auto" title="Auto" src="<?php echo $_SESSION["EVENTKARTE_LIB_URL"]; ?>/icons/car.png" /></a>
		<a onclick="choseType(this);" data-value="1">
			<img alt="Zug" title="Zug" src="<?php echo $_SESSION["EVENTKARTE_LIB_URL"]; ?>/icons/train.png" /></a>
		<a onclick="choseType(this);" data-value="2">
			<img alt="Schiff" title="Schiff" src="<?php echo $_SESSION["EVENTKARTE_LIB_URL"]; ?>/icons/ship.png" /></a>
		<a onclick="choseType(this);" data-value="3">
			<img alt="Bus" title="Bus" src="<?php echo $_SESSION["EVENTKARTE_LIB_URL"]; ?>/icons/bus.png" /></a>
		<a onclick="choseType(this);" data-value="4">
			<img alt="Fahrrad" title="Fahrrad" src="<?php echo $_SESSION["EVENTKARTE_LIB_URL"]; ?>/icons/bicycle.png" /></a>
		<a onclick="choseType(this);" data-value="5">
			<img alt="Flugzeug" title="Flugzeug" src="<?php echo $_SESSION["EVENTKARTE_LIB_URL"]; ?>/icons/aeroplane.png" /></a>
	</div>
	<input onfocus="this.type='number' min="0" max="99" class="eventkarte-free-seats" placeholder="Plätze frei" />
</div>
