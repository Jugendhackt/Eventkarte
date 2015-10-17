<script src="<?php echo EVENTKARTE_LIB_URL; ?>/script.js"></script>

<script>
var EVENTKARTE_LIB_URL = "<?php echo EVENTKARTE_LIB_URL; ?>";
var EVENTKARTE_EVENT_POSITION = {"latitude":"<?php echo explode('/', EVENTKARTE_EVENT_LOCATION)[0]; ?>",
								"longitude":"<?php echo explode('/', EVENTKARTE_EVENT_LOCATION)[1]; ?>"};
</script>
<div id="eventkarte">
	<div style="padding:20px;border:1px solid black;" id="map"></div>
	<div>
		<h2>Route eintragen</h2>
		<form>
			<input placeholder="Name" id="eventkarte-ownername" />
			<input placeholder="E-Mail (nicht öffentlich)" id="eventkarte-ownermail" />
			<textarea placeholder="Kommentar" id="eventkarte-comment"></textarea>

			<div class="eventkarte-route-segment">
				<?php include("route-segment.php"); ?>
			</div>

			<div class="eventkarte-route-location">
				<input id="eventkarte-location-destination" class="eventkarte-location" placeholder="Ort" value="Jugend Hackt" disabled/>
				<input id="eventkarte-location-time" class="eventkarte-time" placeholder="Zeit"/>
			</div>
			<input id="eventkarte-submit" type="button" value="Einstellen" onclick="insertRoute();" />
		</form>
	</div>
</div>
<script src="<?php echo EVENTKARTE_LIB_URL; ?>/map.js"></script>
