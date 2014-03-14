<?


require_once("js/park-query.php");

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP National Parks Exercise</title>
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-bootstrap.css" rel="stylesheet" />
    <link href="css/tablesort.css" rel="stylesheet" />
    <!-- <link href="css/jq.css" rel="stylesheet" /> -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<style>

		tr {
			padding: 10px;
		}

		td {
			padding: 5px;
		}
		
	</style>
	<script src="js/jquery-latest.js"></script>
    
	<script src="js/jquery.tablesorter.js"></script>
        <script>
        $(document).ready(function() {
        	$('.tablesorter').tablesorter()
        });

        </script>
	
</head>
<body>

<h2>National Parks</h2>
<br />
<table id="#parkTable" class="tablesorter table table-striped table-hover">
	<thead>
		<th>#</th>
			
		<th>Name</th>
			
		<th>State</th>
		
		<th>Description</th>
		
		<th>Area (acres)</th>
		
		<th>Date Established</th> 
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
</body>
</html>