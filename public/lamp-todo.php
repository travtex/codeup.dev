<?

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'todo_list');

if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' 
			. $mysqli->connect_error . PHP_EOL);
} 

$todos_data = $mysqli->query("SELECT * FROM todos;" );

$mysqli->close();

?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LAMP Todo List</title>

	<link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>

	<div class="container clearfix"  id="main">
		<div class="row">
			<div class="col-md-6">
				<h2>This is the TODO List!</h2>
				<ul>
					<?

					while ($row = $todos_data->fetch_assoc()) {
					    echo '<li> ' . $row['todo'] . '<span class="hidden">' . 
					    $row['id'] . '</span><a class="snip" href="?remove=' . $row['id'] . 
					    '"> &#9988;</a></li>';
					}

					?>
				</ul>
			</div>
		</div>


	</div>
	
</body>
</html>