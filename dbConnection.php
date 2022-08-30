<?php
require_once './dbConfig.php';

function dbConnect($database) {
	global $DB_CONFIG;
	return mysqli_connect($DB_CONFIG[$database]['hostname'], $DB_CONFIG[$database]['username'], $DB_CONFIG[$database]['password'], $DB_CONFIG[$database]['database']);
}
?>