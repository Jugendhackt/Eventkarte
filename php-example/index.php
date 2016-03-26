<!DOCTYPE html>
<html>
    <head>
        <title>Eventkarte</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script src="../php-lib/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="../php-lib/leaflet.js"></script>
        <link rel="stylesheet" href="../php-lib/leaflet.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <div id="header"><h1>Eventkarte</h1></div>
        <div id="content">
            <?php
            define("EVENTKARTE_DB_PATH", realpath(dirname(__FILE__)) . "/eventkarte.db");
            define("EVENTKARTE_LIB_URL", "http://localhost/Eventkarte/php-lib");
            define("EVENTKARTE_EVENT_ICON", realpath(dirname(__FILE__)) . "/icon.png");
            define("EVENTKARTE_EVENT_LOCATION", "52.5166667/13.4");
            define("EVENTKARTE_EVENT_NAME", "Jugend Hackt");
            include("../php-lib/library.php");
            ?>
        </div>
    </body>
</html>
