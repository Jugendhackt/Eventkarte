<html>
	<head>
		<title>Eventkarte</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
	</head>
	<body>
		<div id="header"><h1>Eventkarte</h1></div>
		<div id="content">
			<?php
			define("EVENTKARTE_DB_PATH", realpath(dirname(__FILE__)) . "/eventkarte.db");
			define("EVENTKARTE_LIB_URL", "http://localhost/Eventkarte/php-lib");
			define("EVENTKARTE_EVENT_LOCATION", "52.5166667/13.4");
			include("../php-lib/library.php");
			?>
		</div>
	</body>
</html>
