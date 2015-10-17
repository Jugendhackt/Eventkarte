<?php

$dir = 'sqlite:'.$_SESSION["EVENTKARTE_DB_PATH"];
$database = new PDO($dir) or die("cannot open the database");


