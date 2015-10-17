<?php

$dir = 'sqlite:geonames.db';
$database = new PDO($dir) or die("cannot open the database");


$handle = fopen("DE.txt", "r");
if ($handle) {
	$nr = 0;
    while (($line = fgets($handle)) !== false) {
		$nr++;
        $info = explode("	", $line);
		
		$stmt = $database->prepare("INSERT INTO geonames (name, lat, lon) "
			. "VALUES (:name, :lat, :lon)");
		$stmt->bindValue(':name', trim($info[1]));
		$stmt->bindValue(':lat', trim($info[4]));
		$stmt->bindValue(':lon', trim($info[5]));
		$stmt->execute();
		
		if($nr % 100 == 0) {
			echo $nr.": ".$info[1].", [...], ";
			flush();
			set_time_limit(30);
		}
    }
    fclose($handle);
	echo "<br /><br />Finished.";
}

