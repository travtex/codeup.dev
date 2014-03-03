<?php 

$new_entry = [];
$errors = [];
$filename = "data/address_book.csv";

// Address book handler class included
require_once('classes/address_data_store.php');

$address_book = new AddressDataStore($filename);

// Loads address .csv file, or empty array if absent
if (file_exists($filename)) {
	$address_array = $address_book->read();
} else {
	$address_array = [];
}

// Validate $_POST data, push new entry to array, save to .csv
if(!empty($_POST)) {
	$new_entry = $address_book->set_entry($_POST);
	if(empty($new_entry[0]) || empty($new_entry[1]) || empty($new_entry[2])
		|| empty($new_entry[3]) || empty($new_entry[4])) {
	empty($new_entry[0]) ? $errors[] = "Name" : false;
	empty($new_entry[1]) ? $errors[] = "Address" : false;
	empty($new_entry[2]) ? $errors[] = "City" : false;
	empty($new_entry[3]) ? $errors[] = "State" : false;
	empty($new_entry[4]) ? $errors[] = "Zip" : false;
	} else {
	$address_array[] = $new_entry;
	$address_book->write($address_array);
	$new_entry = [];
	}
}

// Delete entries and save to .csv
if(isset($_GET['remove'])) {
	unset($address_array[$_GET['remove']]);
	$address_book->write($address_array);
	header("Location: address_book.php");
	exit(0);
}

if (count($_FILES) > 0 && $_FILES['file001']['error'] == 0) {
    if($_FILES['file001']['type'] == 'text/csv') {
         // Set the destination directory for uploads
         $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
         // Grab the filename from the uploaded file by using basename
         $filename = basename($_FILES['file001']['name']);
         // Create the saved filename using the file's original name and our upload directory
         $saved_filename = $upload_dir . $filename;
         // Move the file from the temp location to our uploads directory
         move_uploaded_file($_FILES['file001']['tmp_name'], $saved_filename);
         $new_addresses = new AddressDataStore("uploads/" . $filename);
	     $address_array = array_merge($address_array, $new_addresses->read());
	     $address_book->write($address_array);
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
    <link rel="stylesheet" href="css/default.css">

     <style>

    .snip {
        -webkit-transition: all .3s ease-in-out !important;
        
    }

    .snip:hover {
        display: inline-block;
        text-decoration: none;
        -webkit-transform: rotate(180deg) scale(1.4);
        position: relative;
        
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
				<td><a class="snip" href="?remove=<?= $key ?>">&#9988;</a></td>
			</tr>
			<? endforeach; ?>
		<? else: ?>
			<tr>
				<td style="text-align:center;"><strong>No Addresses Available</strong></td>
			</tr>
		<? endif; ?>
	

	</table>
	<hr />
	<form method="POST" enctype="multipart/form-data" action="" name="form1">
        <div class="form-group">
        	<label for="name">Name: 
        		<input type="text" class="form-control" name="name" id="name" placeholder="Name."
        		<? if(!empty($new_entry[0])): ?> value="<?= $new_entry[0]; endif;?>" />
        	</label><br />
        	<label for="address">Address: 
        		<input type="text" class="form-control" name="address" id="address" placeholder="Address." 
        		<? if(!empty($new_entry[1])): ?> value="<?= $new_entry[1]; endif; ?>"/>
        	</label><br />
        	<label for="city">City: 
        		<input type="text" class="form-control" name="city" id="city" placeholder="City." 
        		<? if(!empty($new_entry[2])): ?> value="<?= $new_entry[2]; endif; ?>"/>
        	</label><br />
        	<label for="state">State: 
        		<input type="text" class="form-control" name="state" id="state" placeholder="State." 
        		<? if(!empty($new_entry[3])): ?> value="<?= $new_entry[3]; endif; ?>"/>
        	</label><br />
        	<label for="zip">Zip: 
        		<input type="text" class="form-control" name="zip" id="zip" placeholder="Zip."
        		<? if(!empty($new_entry[4])): ?> value="<?= $new_entry[4]; endif; ?>" />
        	</label><br />
        	<label for="phone">Phone: 
        		<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone." 
        		<? if(!empty($new_entry[5])): ?> value="<?= $new_entry[5]; endif; ?>"/>
        	</label><br /><br />
		    <? if(!empty($errors)) : ?>
		    <p>Missing Fields: <mark> <? foreach($errors as $error) : ?>
		    				<?= $error ?>
		    			<? endforeach; ?></mark></p>
    		<? endif; ?>
        	<button type="submit" class="btn btn-primary">Add New Address</button>
        </div>
    </form>
    <hr />
    <form method="POST" enctype="multipart/form-data" action="" name="form2">
    	<div class="form-group">
        	<p>
                <? if(count($_FILES) > 0 && $_FILES['file001']['name'] != "" && $_FILES['file001']['type'] !== 'text/csv') :
                    echo "<p><mark>Uploaded files must be in .csv format.</mark></p>";
                endif; ?>
                <label for="file001">Add a .csv file of Addresses: </label>
                <input type="file" id="file001" name="file001" />
            </p>
             <button type="submit" class="btn btn-warning">Add From File</button>
         </div>
     </form>
	    </div>
</body>
</html>