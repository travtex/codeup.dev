<?php

echo "<h3>Form Information</h3><hr style=\"height:2px; width: 95%; background-color:navy; border-radius:20px;\"/>";
echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);
echo "<hr style=\"height:2px; width:95%; background-color:navy; border-radius:20px;\"/>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TODO List</title>
	<style type="text/css">
	html {
		height: 100%;
	}
	body {
		margin: 20px;
	}
	hr {
		height: 2px;
		background-color: navy;
	}

	</style>
</head>
<body>
	<div style="background:-webkit-radial-gradient(left top, lightsteelblue, white);">
	<h2 style="color:darkgreen;">This is the TODO List</h2>
		<ul>
			<li>Knick Knack</li>
			<li>Paddy Whack</li>
			<li>Give a Dog a Bone</li>
			<li>Come Rolling Home</li>
		</ul>

	<hr style="height:2px; background-color:navy;"/>

	<form method="POST" action="">
		<p>
			<label for="add">Enter a new list item: </label>
		</p>
		<input id="add" name="add" type="text" placeholder="New list item.">
		<p>
			<input type="submit" value="Add New Item">
		</p>
	</form>

	<hr />

	</div>
</body>
</html>