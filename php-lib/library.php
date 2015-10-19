<?php

if(!defined("EVENTKARTE_DB_PATH") || !defined("EVENTKARTE_EVENT_LOCATION")  ||
   !defined("EVENTKARTE_LIB_URL")) {
	exit("<strong>Eventkarte:</strong> Please define EVENTKARTE_DB_PATH, EVENTKARTE_LIB_URL and EVENTKARTE_EVENT_LOCATION");
}
if(defined("EVENTKARTE_LIB_PATH")) {
	exit("<strong>Eventkarte:</strong> Only one map allowed per page");
}
define("EVENTKARTE_LIB_PATH", realpath(dirname(__FILE__)));

session_start();
$_SESSION["EVENTKARTE_DB_PATH"] = EVENTKARTE_DB_PATH;
$_SESSION["EVENTKARTE_LIB_URL"] = EVENTKARTE_LIB_URL;
$_SESSION["EVENTKARTE_EVENT_ICON"] = EVENTKARTE_EVENT_ICON;
$_SESSION["EVENTKARTE_EVENT_NAME"] = EVENTKARTE_EVENT_NAME;

include(EVENTKARTE_LIB_PATH . "/connect_db.php");

include(EVENTKARTE_LIB_PATH . "/templates/base.php");

