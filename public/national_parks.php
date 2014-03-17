<?

$ex_error = '';

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' 
			. $mysqli->connect_error . PHP_EOL);
} 


$sort_order = 'asc';
$validCol = ['name', 'state', 'date_established', 'area_in_acres'];

// if(!empty($_GET)) {
// 	$sort_column = $_GET['sort_column'];
// 	$sort_order = $_GET['sort_order'];
// } else {
// 	$sort_column = 'name';
// 	$sort_order = 'asc';
// }

if (!empty($_GET) && in_array($_GET['sort_column'], $validCol)) {
	$sort_column = $_GET['sort_column'];
	
} else {
	$sort_column = 'name';

}

if (!empty($_GET) && ($_GET['sort_order'] != 'desc')) {
	$sort_order = 'asc';
} else {
	$sort_order = 'desc';
}

$parks_data = $mysqli->query("SELECT * FROM national_parks ORDER BY " . $sort_column
				. " " . $sort_order );

if (!empty($_POST)) {
	
	try {
		if(empty($_POST['parkname']) || empty($_POST['parkstate']) || 
		   empty($_POST['parkdesc']) || empty($_POST['parkdate']) || 
		   empty($_POST['parkacre'])) {
			throw new Exception("Must fill all entries.");
		} else {
		$stmt = $mysqli->prepare("INSERT INTO national_parks (name, state, description, 
			date_established, area_in_acres) VALUES(?, ?, ?, ?, ?)");

		$stmt->bind_param("ssssd", htmlspecialchars($_POST['parkname']), 
			htmlspecialchars($_POST['parkstate']),
			htmlspecialchars($_POST['parkdesc']), 
			htmlspecialchars($_POST['parkdate']), 
			htmlspecialchars($_POST['parkacre']));

		$stmt->execute();
		}
	} catch (Exception $e) {
		$ex_error = $e->getMessage();
	}
	
}

$mysqli->close();

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP National Parks Exercise</title>
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-bootstrap.css" rel="stylesheet" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<style>


		tr {
			padding: 10px;
		}

		td {
			padding: 5px;
		}
		a {
			text-decoration: none !important;
		}
		a:hover {
			color: #055;
		}

		#addForm {
			width: 85%;
			margin: auto;
		}
		.entry {
			width: 600px;

		}

		#parkdesc {
			height: 200px;
		}

	</style>
	
</head>
<body>

	<div class="container clearfix">

		<h2>National Parks</h2>
		<br />
		<table id="#parkTable" class="table table-striped table-hover tablesorter">
			<thead>
				<th>#
					<br /><br />
				</th>
					
				<th>Name
					<br />
					<small><a href="?sort_column=name&amp;sort_order=asc">
						<span class="glyphicon glyphicon-chevron-up"></span></a> / 
						<a href="?sort_column=name&amp;sort_order=desc">
							<span class="glyphicon glyphicon-chevron-down"></span>
						</a></small>
				</th>
					
				<th>State
					<br />
					<small><a href="?sort_column=state&amp;sort_order=asc">
						<span class="glyphicon glyphicon-chevron-up"></span>
					</a> / 
						<a href="?sort_column=state&amp;sort_order=desc">
							<span class="glyphicon glyphicon-chevron-down"></span>
						</a></small>
				</th>
				
				<th>Description
					<br /><br />
				</th>
				
				<th>Area (acres)
					<br />
					<small><a href="?sort_column=area_in_acres&amp;sort_order=asc">
						<span class="glyphicon glyphicon-chevron-up"></span>
					</a> / 
						<a href="?sort_column=area_in_acres&amp;sort_order=desc">
							<span class="glyphicon glyphicon-chevron-down"></span>
						</a></small>
					<br />
				</th>
				
				<th>Date Established
					<br />
					<small><a href="?sort_column=date_established&amp;sort_order=asc">
						<span class="glyphicon glyphicon-chevron-up"></span></a> / 
						<a href="?sort_column=date_established&amp;sort_order=desc">
							<span class="glyphicon glyphicon-chevron-down"></span></a></small>
				</th> 
			</thead>
			<tbody>
		<?

		while ($row = $parks_data->fetch_assoc()) {
		    echo '<tr><td class=\'id\'>' . $row['id'] . '</td>' .
		    	'<td class=\'name\'>' . $row['name'] . '</td>' .
		    	'<td class=\'state\'>' . $row['state'] . '</td>' .
		    	'<td class=\'text-justify description\'>' . $row['description'] . '</td>' .
		    	'<td class=\'acres\'>' . $row['area_in_acres'] . '</td>' .
		    	'<td class=\'established\'>' . $row['date_established'] . '</td></tr>';
		}

		?>
			</tbody>

		</table>

		<form role="form" id="addForm" method="POST" enctype="multipart/form-data" action="" name="form1">
			<div class="form-group">
				<label for="parkname">Name: <input type="text" class="form-control entry" id="parkname"
					placeholder="Enter Park Name" name="parkname" />
				</label>
			</div>

			<div class="form-group">
				<label for="parkstate">State: <input type="text" class="form-control entry" id="parkstate"
					placeholder="Enter Park State" name="parkstate" />
				</label>
			</div>

			<div class="form-group">
				<label for="parkdesc">Description: <input type="textarea" class="form-control entry" id="parkdesc"
					placeholder="Enter Park Description" name="parkdesc" />
				</label>
			</div>

			<div class="form-group">
				<label for="parkacre">Size (Area in Acres): <input type="text" class="form-control entry" id="parkacre"
					placeholder="Enter Park Area" name="parkacre" />
				</label>
			</div>

			<div class="form-group">
				<label for="parkdate">Date Established (YYYY-MM-DD): <input type="text" class="form-control entry" id="parkacre"
					placeholder="Enter Park Date Established" name="parkdate" />
				</label>
			</div>
			<button type="submit" class="btn btn-primary">Add New Park</button>

			<? if (!empty($ex_error)) : ?>
				<h3><mark><?= $ex_error; ?></mark></h3>
			<? endif; ?>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        
</body>
</html>