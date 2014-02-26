<?php 

$new_entry = [];
$address_array = [];
$errors = [];
$filename = "data/address_book.csv";

function import_addresses($filename){
	$contents = [];
	$handle = fopen($filename, "r");
	while(($data = fgetcsv($handle)) !== FALSE) {
		$contents[] = $data;
	}
	fclose($handle);
	return $contents;
}

function save_addresses($filename, $address_array){
	$handle = fopen($filename, "w");
	foreach($address_array as $fields){
		fputcsv($handle, $fields);
	}
	fclose($handle);
}

function set_entry($array) {
	$entry = [
		htmlspecialchars(strip_tags($array['name'])),
		htmlspecialchars(strip_tags($array['address'])),
		htmlspecialchars(strip_tags($array['city'])),
		htmlspecialchars(strip_tags($array['state'])),
		htmlspecialchars(strip_tags($array['zip'])),
		htmlspecialchars(strip_tags($array['phone']))
		];
	return $entry;
}
if (file_exists($filename)) {
	$address_array = import_addresses($filename);
} else {
	$address_array = [];
}

if(!empty($_POST)){
	$new_entry = set_entry($_POST);
	if(empty($new_entry[0]) || empty($new_entry[1]) || empty($new_entry[2])
		|| empty($new_entry[3]) || empty($new_entry[4])) {
	empty($new_entry[0]) ? $errors[] = "Name" : false;
	empty($new_entry[1]) ? $errors[] = "Address" : false;
	empty($new_entry[2]) ? $errors[] = "City" : false;
	empty($new_entry[3]) ? $errors[] = "State" : false;
	empty($new_entry[4]) ? $errors[] = "Zip" : false;
	} else {
	$address_array[] = $new_entry;
	save_addresses($filename, $address_array);
	}
}

?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Address Book</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>
	<h2>Address Book</h2>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>Address</td>
			<td>City</td>
			<td>State</td>
			<td>Zip</td>
			<td>Phone</td>
		</tr>
		<? if(!empty($address_array)): ?>
			<? foreach($address_array as $address): ?>
			<tr>
				<? foreach($address as $value): ?>
				<td><?= $value; ?></td>
				<? endforeach; ?>
			</tr>
			<? endforeach; ?>
		<? endif; ?>
	

	</table>
	<hr />
	<form method="POST" enctype="multipart/form-data" action="" name="form1">
        <div class="form-group">
        	<label for="name">Name: 
        		<input type="text" class="form-control" name="name" id="name" placeholder="Name." />
        	</label><br />
        	<label for="address">Address: 
        		<input type="text" class="form-control" name="address" id="address" placeholder="Address." />
        	</label><br />
        	<label for="city">City: 
        		<input type="text" class="form-control" name="city" id="city" placeholder="City." />
        	</label><br />
        	<label for="state">State: 
        		<input type="text" class="form-control" name="state" id="state" placeholder="State." />
        	</label><br />
        	<label for="zip">Zip: 
        		<input type="text" class="form-control" name="zip" id="zip" placeholder="Zip." />
        	</label><br />
        	<label for="phone">Phone: 
        		<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone." />
        	</label><br /><br />
		    <? if(!empty($errors)) : ?>
		    <p>Missing Fields: <mark> <? foreach($errors as $error) : ?>
		    				<?= $error ?>
		    			<? endforeach; ?></mark></p>
    		<? endif; ?>
        	<button type="submit" class="btn btn-primary">Add New Address</button>
        </div>
    </form>

</body>
</html>