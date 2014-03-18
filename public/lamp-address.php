<?php

$limit = 5;
$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'address_book');

if (!empty($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

if ($page > 1) {
	$offset = ($_GET['page'] * $limit) - $limit;
}

$stmt = $mysqli->prepare("SELECT CONCAT(p.last_name, ', ', p.first_name)
                          AS full_name, ad.street, ad.city, ad.state, ad.zip
                          FROM people AS p JOIN assoc ON assoc.person_id = p.id
                          JOIN address AS ad ON ad.id = assoc.address_id LIMIT ? 
                          OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$stmt->bind_result($name, $street, $city, $state, $zip);
$rows = [];

while ($stmt->fetch()) {
	$rows[] = array('full_name' => $name, 'street' => $street, 'city' => $city,
					'state' => $state, 'zip' => $zip);
}

var_dump($rows);
?>



<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LAMP Address Book</title>
	<link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>
	<div id="main">
		test
	</div>
</body>
</html>