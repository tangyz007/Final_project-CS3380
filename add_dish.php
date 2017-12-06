<?php
	require ('db_credentials.php');
	require ('web_utils.php');
	
	$stylesheet = 'taskmanager.css';
	
	$Menu = $_POST['Menu'];
	$Price = $_POST['Price'] ? $_POST['Price'] : "None";
	$Ingredients = $_POST['Ingredients'] ? $_POST['Ingredients'] : "";
    $Sauce = $_POST['Sauce'] ? $_POST['Sauce'] : "None";
	

    $x=$_POST['Table'];

	
	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($mysqli->connect_error) {
		print generatePageHTML("Tasks (Error)", generateErrorPageHTML($mysqli->connect_error), $stylesheet);
		exit;
	}
	
	$Menu = $mysqli->real_escape_string($Menu);
	$Price = $mysqli->real_escape_string($Price);
	$Ingredients = $mysqli->real_escape_string($Ingredients);
	$Sauce = $mysqli->real_escape_string($Sauce);

	$sql = "INSERT INTO ".$x." (Menu, Price, Ingredients, Sauce) VALUES ('$Menu', '$Price', '$Ingredients','$Sauce')";
	
	$result = $mysqli->query($sql);
	if ($result) {
		// insert successfull, redirect browser to index.php to see list of tasks
		redirect("back.php");
	} else {
		print generatePageHTML("Tasks (Error)", generateErrorPageHTML($mysqli->error . " using SQL: $sql"), $stylesheet);
		exit;
	}
	
	
	function generateErrorPageHTML($error) {
	$html = <<<EOT
<h1>Tasks</h1>
<p>An error occurred: $error</p>
<p><a class='taskButton' href='task_form.html'>Add Task</a><a class='taskButton' href='view_tasks.php'>View Tasks</a></p>
EOT;

	return $html;
	}
?>