<?php 

$address_array = [];
$filename = "data/address_book.csv";

function import_data($filename) {
    if (filesize($filename) == 0) {
        return FALSE;
    }
    else {
        $handle = fopen($filename, "r");
        $contents = fgetcsv($handle, filesize($filename));
        fclose($handle);
        return $contents;
    }
}

function new_address(&$address){
	$address[] = $_POST;
}

function save_file($filename, $address) {
    $handle = fopen($filename, "a");
    foreach($address as $fields) {
    	fputcsv($handle, $fields);
    }
    fclose($handle);
}

$address_array = import_data($filename);

if(isset($_POST)) {
	$new_address = $_POST;
	$handle = fopen($filename, "a");
	fputcsv($handle, $new_address);
	fclose($handle);
}

var_dump($address_array);
var_dump($new_address);

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
			<tr>
			<? foreach($address_array as $address => $value): ?>
			
				<td><?= $value; ?></td>
				
			<? endforeach; ?>
			</tr>
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