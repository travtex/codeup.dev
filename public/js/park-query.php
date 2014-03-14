<?php

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' 
			. $mysqli->connect_error . PHP_EOL);
} 


$parks_data = $mysqli->query("SELECT * FROM national_parks");

?>