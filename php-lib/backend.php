<?php
session_start();
include("./connect_db.php");

if(isset($_POST["create-route"])) {
	$route = json_decode($_POST["create-route"]);

	$stmt = $database->prepare("INSERT INTO routes (owner_name, owner_mail, access_key, comment) "
			. "VALUES (:owner_name, :owner_mail, :access_key, :comment)");
	$stmt->bindParam(':owner_name', $route["ownername"]);
	$stmt->bindParam(':owner_mail', $route["ownermail"]);
	$stmt->bindParam(':comment', $route["comment"]);
	//TODO
	$stmt->bindParam(':access_key', "TODO:ertkinzw8765ig");
	$stmt->execute();


	/*$query =  "SELECT * FROM combo_calcs WHERE options='easy'";
	foreach ($dbh->query($query) as $row) {
		echo $row[0];
	}*/
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
			$segment["end"] = array("latitude" => (float) $start[0], "longitude" => (float) $start[1]);
			$segment["time"] = (int) $row["time"];
			$segment["free_seats"] = (int) $row["free_seats"];
			$route["segments"][] = $segment;
		}
		$routes[] = $route;
	}
	echo json_encode($routes);
} else {
	echo "Unknown request.";
}

