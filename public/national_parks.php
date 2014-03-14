<?


$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' 
			. $mysqli->connect_error . PHP_EOL);
} 

if(!empty($_GET)) {
	$sort_column = $_GET['sort_column'];
	$sort_order = $_GET['sort_order'];
} else {
	$sort_column = 'name';
	$sort_order = 'asc';
}

$parks_data = $mysqli->query("SELECT * FROM national_parks ORDER BY " . $sort_column
				. " " . $sort_order );

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

	</style>
	
</head>
<body>

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
			<br /><br />
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        
</body>
</html>