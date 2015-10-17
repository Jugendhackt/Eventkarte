<div class="eventkarte-route-location">
	<input class="eventkarte-location" placeholder="Ort" />
	<input class="eventkarte-time" placeholder="Zeit"/>
</div>
<div class="eventkarte-route-type">
	<a onclick="addRouteSegment(this);" class="eventkarte-route-plus">+</a>
	<div class="eventkarte-route-types">
		<a onclick="choseType(this);" data-value="0" class="selected">Auto</a>
		<a onclick="choseType(this);" data-value="1">Zug</a>
		<a onclick="choseType(this);" data-value="2">Schiff</a>
		<a onclick="choseType(this);" data-value="3">Bus</a>
		<a onclick="choseType(this);" data-value="4">Fahrrad</a>
		<a onclick="choseType(this);" data-value="5">Flugzeug</a>
	</div>
	<input class="eventkarte-free-seats" placeholder="Freie Plätze" />
</div>
