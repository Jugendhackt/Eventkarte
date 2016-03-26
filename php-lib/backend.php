<?php
include("../connect_db.php");
include("../constants.php");

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
} else if(isset($_POST["sendmail"])) {
	$stmt = $database->query("select * from route_segments,routes where route_segments.id == '".(int)$_POST["sendmail"]."' AND routes.id == route_segments.route_id");
	$stmt->execute();
	$rows = $stmt->fetchAll();

	$empfaenger = $rows[0]["owner_mail"];
        $nachricht = "Hallo ".$rows[0]["owner_name"].", \n\nDer Nutzer \"".$_POST["sender_name"]
                ."\" hat Dir über die Eventkarte von \"".EVENTKARTE_EVENT_NAME
                ."\" folgende Nachricht gesendet:\n\n==================\n\n";
	$nachricht .= $_POST["text"];
	$header = 'From: system@jugendhackt.de' . "\r\n" .
		'Reply-To: '. $_POST["sender_mail"]. "\r\n" .
		'Content-Type: text/plain;charset=utf-8';
	$result = mail($empfaenger, "Kontaktanfrage von ".$_POST["sender_name"]." (Eventkarte)", $nachricht, $header);
	if(!$result) {
		echo "Sending failed";
	}
} else {
	echo "Unknown request.";
}

