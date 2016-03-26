<?php

$dir = 'sqlite:'.dirname(__FILE__).'/eventkarte.db';
$database = new PDO($dir) or die("cannot open the database");


