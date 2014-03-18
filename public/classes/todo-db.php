<?php


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