<?php

if(!defined("EVENTKARTE_DB_PATH") || !defined("EVENTKARTE_EVENT_LOCATION")  ||
   !defined("EVENTKARTE_LIB_URL")) {
	exit("<strong>Eventkarte:</strong> Please define EVENTKARTE_DB_PATH, EVENTKARTE_LIB_URL and EVENTKARTE_EVENT_LOCATION");
}
define("EVENTKARTE_LIB_PATH", realpath(dirname(__FILE__)));

include(EVENTKARTE_LIB_PATH . "/base.html");

