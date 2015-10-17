<?php

//$_SESSION["EVENTKARTE_DB_FULL_PATH"];

$dir = 'sqlite:'.$_SESSION["EVENTKARTE_DB_PATH"];
$database = new PDO($dir) or die("cannot open the database");
/*$query =  "SELECT * FROM combo_calcs WHERE options='easy'";
foreach ($dbh->query($query) as $row) {
    echo $row[0];
}*/

