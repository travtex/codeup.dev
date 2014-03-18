<?php

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'address_book');
$limit = 5;

if (!empty($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

if ($page > 1) {
	$offset = ($_GET['page'] * $limit) - $limit;
}

$stmt = $mysqli->prepare("SELECT p.id, CONCAT(p.last_name, ', ', p.first_name)
                          AS full_name, ad.street, ad.city, ad.state, ad.zip
                          FROM people AS p JOIN assoc ON assoc.people_id = p.id
                          JOIN address AS ad ON ad.id = assoc.address_id LIMIT ? 
                          OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$stmt->bind_result($id, $name, $street, $city, $state, $zip);
$rows = [];

while ($stmt->fetch()) {
	$rows[] = array('id' => $id, 'full_name' => $name, 'street' => $street, 'city' => $city,
					'state' => $state, 'zip' => $zip);
}

// SAMPLE ASSOC QUERY
// insert into assoc (people_id, address_id)
// values (
// 	(select id from people
// 		where (first_name, last_name) = ('Travis', 'Flatt')),
// 	(select id from address
// 		where (street, city, state, zip) = ('2415 Karat Drive', 'San Antonio', 'TX', 78232))
// );


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
	<div id="main" class="container clearfix">
		<table class="table table-striped">
			<thead>
				<tr>
					<td>Name</td>
					<td>Street</td>
					<td>City</td>
					<td>State</td>
					<td>Zip</td>
					<td>Delete</td>
				</tr>
			</thead>
			<tbody>
				<? foreach($rows as $key => $row) : ?>
					<tr>
						<td><?= $row['full_name']; ?></td>
						<td><?= $row['street']; ?></td>
						<td><?= $row['city']; ?></td>    
						<td><?= $row['state']; ?></td>
						<td><?= $row['zip']; ?></td>
						<td><a href="#"><i class="fa fa-trash-o fa-2"></i></a></td>
					</tr>
				<? endforeach; ?>

			</tbody>
		</table>
		<!-- Button trigger modal -->
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		  <i class="fa fa-home"></i> Add New Address
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add New Address</h4>
		      </div>
		      <div class="modal-body">
		      	<form action="lamp-address.php" method="POST" name="form001" ></form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button type="button" class="btn btn-primary">Save Address</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</body>
</html>