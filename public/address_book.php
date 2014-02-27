<?php 

$new_entry = [];
$address_array = [];
$errors = [];
$filename = "data/address_book.csv";

// Load .csv file of addresses
function import_addresses($filename){
	$contents = [];
	$handle = fopen($filename, "r");
	while(($data = fgetcsv($handle)) !== FALSE) {
		$contents[] = $data;
	}
	fclose($handle);
	return $contents;
}

// Save addresses to .csv file
function save_addresses($filename, $address_array){
	$handle = fopen($filename, "w");
	foreach($address_array as $fields){
		fputcsv($handle, $fields);
	}
	fclose($handle);
}

// Set an array to a new entry
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

// Loads address .csv file, or empty array if absent
if (file_exists($filename)) {
	$address_array = import_addresses($filename);
} else {
	$address_array = [];
}


// Validate $_POST data, push new entry to array, save to .csv
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

// Delete entries and save to .csv
if(isset($_GET['remove'])){
	unset($address_array[$_GET['remove']]);
	save_addresses($filename, $address_array);
	header("Location: address_book.php");
	exit(0);
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
    <style type="text/css">
    html {
        height: 100%;
    }
    body {
        background-image: url('img/dark-blue-background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        margin: 20px;
    }
    hr {
        height: 2px;
        border-color: teal !important;
        border-width: 2px !important;
    }
    div {
        padding: 20px;
        border-radius: 20px;

    }

    #main {
        background: -webkit-radial-gradient(left top, lightsteelblue, white);
        margin: 20px auto;
        width: 85%;
        border-style:groove;
        border-width: 3px;
        border-color: teal;
    }

    #main h2{
        color: darkgreen;
    }

    ul {
        font-size: 14pt;
    }
    </style>
</head>
<body>
	<div id="main">
	<h2>Address Book</h2>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>Address</td>
			<td>City</td>
			<td>State</td>
			<td>Zip</td>
			<td>Phone</td>
			<td>Delete?</td>
		</tr>
		<? if(!empty($address_array)): ?>
			<? foreach($address_array as $key => $address): ?>
			<tr>
				<? foreach($address as $value): ?>
				<td><?= $value; ?></td>
				<? endforeach; ?>
				<td><a href="?remove=<?= $key ?>">X</a></td>
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
        </div>
    </form>

</body>
</html>