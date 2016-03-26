<!DOCTYPE html>
<html>
    <head>
        <title>Eventkarte</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script src="php-lib/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="php-lib/leaflet.js"></script>
        <script src="php-lib/script.js"></script>
        <link rel="stylesheet" href="php-lib/leaflet.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <h1>Eventkarte</h1>
        <div id="content">
            <?php
            include("connect_db.php");
            include("constants.php");
            ?>
            <script>
            var EVENTKARTE_EVENT_NAME = "<?php echo EVENTKARTE_EVENT_NAME; ?>";
            var EVENTKARTE_EVENT_POSITION = {"latitude":"52.5166667", "longitude":"13.4"};
            </script>
            <div id="eventkarte">
	            <div>
		            <h2>Route eintragen</h2>
		            <form>
			            <input type="text" placeholder="Name" id="eventkarte-ownername" />
			            <input type="email" placeholder="E-Mail (nicht öffentlich)" id="eventkarte-ownermail" />
			            <textarea placeholder="Kommentar" id="eventkarte-comment"></textarea>

			            <div class="eventkarte-route-segment">
				            <?php include("php-lib/templates/route-segment.php"); ?>
			            </div>

			            <div class="eventkarte-route-location" id="eventkarte-route-destination">
				            <input id="eventkarte-location-destination" class="eventkarte-location" placeholder="Ort" value="<?php echo EVENTKARTE_EVENT_NAME; ?>" disabled/>
                                            <input id="eventkarte-location-time" class="eventkarte-time" placeholder="Zeit"/>
			            </div>
			            <input class="eventkarte-submit" type="button" value="Einstellen" onclick="insertRoute();" />
		            </form>
	            </div>
	            <div id="eventkarte-contact" style="display:none;">
		            <h2><span id="eventkarte-mail-receiver"></span> kontaktieren</h2>
		            <form>
			            <input placeholder="Name" id="eventkarte-sendername" />
			            <input placeholder="E-Mail" id="eventkarte-sendermail" />
			            <input type="hidden" id="eventkarte-receiver_segment" />
			            <textarea placeholder="Nachricht" id="eventkarte-message"></textarea>
			            <input class="eventkarte-submit" type="button" value="Senden" onclick="sendMail();" />
		            </form>
	            </div>
            </div>
            <script src="php-lib/map.js"></script>
        </div>
        <div id="map"></div>
    </body>
</html>
