<?

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'todo_list');

if ($mysqli->connect_errno) {
		throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' 
			. $mysqli->connect_error . PHP_EOL);
} 

$todos_data = $mysqli->query("SELECT * FROM todos;" );




if (!empty($_POST['new_todo'])) {

	$stmt = $mysqli->prepare("INSERT INTO todos (todo) VALUES (?)");
	$stmt->bind_param("s", htmlspecialchars($_POST['new_todo']));
	$stmt->execute();

	header("Location: lamp-todo.php");
}

if (!empty($_GET['remove'])) {
	//$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'todo_list');
	$stmt = $mysqli->prepare('DELETE FROM todos where id = ?');
	$stmt->bind_param("i", htmlspecialchars($_GET['remove']));
	$stmt->execute();

	header("Location: lamp-todo.php");
}

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
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  	<script src="js/jPages.js"></script>
</head>
<body>

	<div class="container clearfix"  id="main">
		<div class="row">
			<div class="col-md-8">
				<h2>This is the TODO List!</h2>
				<ul id="itemContainer">
					<?

					while ($row = $todos_data->fetch_assoc()) {
					    echo '<li> ' . $row['todo'] . '<a class="snip" href="?remove=' . 
					    $row['id'] . '"> &#9988;</a></li>';
					}

					?>
				</ul>
				<div class="holder"></div>
			</div>
			<div class="col-md-4" id="add_todo">
				<br /><br />
				<div class="form-group">
					<form action="" method="POST" name="todo_form" id="addForm">
						<label for="new_todo">Enter New Todo Item:
							<p><input type="text" name="new_todo" id="new_todo" 
								class="form-control entry" /></p>
						</label>
						<p><button type="submit" class="btn btn-success btn-lg">
							<i class="fa fa-plus-square"></i> Enter New Item
						</button></p>
					</form>
				</div>
			</div>
		</div>


	</div>
	
	<script>

		$(document).ready(function () {
			$("div.holder").jPages({
				containerID : "itemContainer",
				perPage     : 10,
				startPage   : 1,
				startRange  : 1,
				midRange    : 5,
				endRange    : 1
			});
			
		});

	</script>
	
</body>
</html>