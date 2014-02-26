<?php 

$new_entry = [];
$address_array = [];
$filename = "data/address_book.csv";

function save_addresses($filename, $address_array){
	$handle = fopen($filename, "a+");
	foreach($address_array as $fields){
		fputcsv($handle, $fields);
	}
	fclose($handle);
}

if(!empty($_POST)){
	$new_entry = [
		htmlspecialchars(strip_tags($_POST['name'])),
		htmlspecialchars(strip_tags($_POST['address'])),
		htmlspecialchars(strip_tags($_POST['city'])),
		htmlspecialchars(strip_tags($_POST['state'])),
		htmlspecialchars(strip_tags($_POST['zip'])),
		htmlspecialchars(strip_tags($_POST['phone']))
		];
	$address_array[] = $new_entry;
	save_addresses($filename, $address_array);
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
        		<input type="text" class="form-control" name="name" id="name" placeholder="Name." required />
        	</label><br />
        	<label for="address">Address: 
        		<input type="text" class="form-control" name="address" id="address" placeholder="Address." required />
        	</label><br />
        	<label for="city">City: 
        		<input type="text" class="form-control" name="city" id="city" placeholder="City." required />
        	</label><br />
        	<label for="state">State: 
        		<input type="text" class="form-control" name="state" id="state" placeholder="State." required />
        	</label><br />
        	<label for="zip">Zip: 
        		<input type="text" class="form-control" name="zip" id="zip" placeholder="Zip." required />
        	</label><br />
        	<label for="phone">Phone: 
        		<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone." />
        	</label><br /><br />
        	<button type="submit" class="btn btn-primary">Add New Address</button>
        </div>
    </form>
</body>
</html>