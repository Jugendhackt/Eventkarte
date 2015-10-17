<?php
session_start();
include("./connect_db.php");

if(isset($_POST["create-route"])) {
	$route = json_decode($_POST["create-route"]);

	$stmt = $database->prepare("INSERT INTO routes (owner_name, owner_mail, access_key, comment) "
			. "VALUES (:owner_name, :owner_mail, :access_key, :comment)");
	$stmt->bindValue(':owner_name', $route->ownername);
	$stmt->bindValue(':owner_mail', $route->ownermail);
	$stmt->bindValue(':comment', $route->comment);
	//TODO
	$stmt->bindValue(':access_key', "TODO:ertkinzw8765ig");
	$stmt->execute();

	$route_id = $database->lastInsertId();

	foreach($route->segments as $segment) {
		$stmt = $database->prepare("INSERT INTO route_segments (route_id, start, end, type, free_seats) "
				. "VALUES (:route_id, :start, :end, :type, :free_seats)");
		$stmt->bindValue(':route_id', $route_id);
		$stmt->bindValue(':start', $segment->start->latitude . "/" . $segment->start->longitude);
		$stmt->bindValue(':end', $segment->end->latitude . "/" . $segment->end->longitude);
		$stmt->bindValue(':type', $segment->type);
		$stmt->bindValue(':free_seats', $segment->freeseats);
		$stmt->execute();
	}

	echo $stmt->errorInfo()[2];
} else if(isset($_GET["get-routes"])) {
	$routes = array();
	foreach ($database->query("SELECT * FROM routes") as $row) {
		$route = array();
		$route["id"] = (int) $row["id"];
		$route["ownername"] = $row["owner_name"];
		$route["comment"] = $row["comment"];
		$route["segments"] = array();
		foreach ($database->query("SELECT * FROM route_segments WHERE route_id = ".$row["id"]) as $row) {
			$segment = array();
			$segment["id"] = (int) $row["id"];
			$start = explode("/", $row["start"]);
			$segment["start"] = array("latitude" => (float) $start[0], "longitude" => (float) $start[1]);
			$end = explode("/", $row["end"]);
			$segment["end"] = array("latitude" => (float) $end[0], "longitude" => (float) $end[1]);
			$segment["time"] = (int) $row["time"];
			$segment["free_seats"] = (int) $row["free_seats"];
			$segment["type"] = (int) $row["type"];
			$route["segments"][] = $segment;
		}
		$routes[] = $route;
	}
	header('Content-Type: text/json');
	header('Content-Disposition: attachment; filename="routes.json"');
	echo json_encode($routes, JSON_PRETTY_PRINT);
} else if($_GET["get-gps"]) {
	$city_name = str_replace("'", "", $_GET["get-gps"]);
	$city_name = strtolower($city_name);
	$dir = 'sqlite:geonames/geonames.db';
	$geodatabase = new PDO($dir) or die("cannot open the database");
	$stmt = $geodatabase->query("select * from geonames where lower(name) == '$city_name'");
	$stmt->execute();
	$rows = $stmt->fetchAll();
	header('Content-Type: text/json');
	header('Content-Disposition: attachment; filename="gps.json"');
	echo json_encode($rows[0], JSON_PRETTY_PRINT);
} else {
	echo "Unknown request.";
}

