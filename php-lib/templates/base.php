<script src="<?php echo EVENTKARTE_LIB_URL; ?>/script.js"></script>

<script>
var EVENTKARTE_LIB_URL = "<?php echo EVENTKARTE_LIB_URL; ?>";
var EVENTKARTE_EVENT_POSITION = {"latitude":"<?php echo explode('/', EVENTKARTE_EVENT_LOCATION)[0]; ?>",
								"longitude":"<?php echo explode('/', EVENTKARTE_EVENT_LOCATION)[1]; ?>"};
</script>
<div id="eventkarte">
	<div id="map"></div>
	<div>
		<h2>Route eintragen</h2>
		<form>
			<input type="text" placeholder="Name" id="eventkarte-ownername" />
			<input type="email" placeholder="E-Mail (nicht öffentlich)" id="eventkarte-ownermail" />
			<textarea placeholder="Kommentar" id="eventkarte-comment"></textarea>

			<div class="eventkarte-route-segment">
				<?php include("route-segment.php"); ?>
			</div>

			<div class="eventkarte-route-location" id="eventkarte-route-destination">
				<input id="eventkarte-location-destination" class="eventkarte-location" placeholder="Ort" value="Jugend Hackt" disabled/>
                                <input id="eventkarte-location-time" class="eventkarte-time" placeholder="Zeit" type="time"/>
			</div>
			<input id="eventkarte-submit" type="button" value="Einstellen" onclick="insertRoute();" />
		</form>
	</div>
	<div id="eventkarte-contact" style="display:none;">
		<h2><span id="eventkarte-mail-receiver"></span> kontaktieren</h2>
		<form>
			<input placeholder="Name" id="eventkarte-sendername" />
			<input placeholder="E-Mail" id="eventkarte-sendermail" />
			<input type="hidden" id="eventkarte-receiver_segment" />
			<textarea placeholder="Nachricht" id="eventkarte-message"></textarea>
			<input id="eventkarte-submit" type="button" value="Senden" onclick="sendMail();" />
		</form>
	</div>
</div>
<script src="<?php echo EVENTKARTE_LIB_URL; ?>/map.js"></script>
