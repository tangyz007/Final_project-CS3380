<?php


	// A user has to have logged in order to have this 'username' cookie
	$username = empty($_COOKIE['username']) ? '' : $_COOKIE['username'];
	
	// If the cookie isn't there, send them back to the login
	if (!$username) {
		header("Location: login.php");
		exit;
	}
?>
<?php

	require ('db_credentials.php');
	require ('web_utils.php');
	
	$stylesheet = 'taskmanager.css';
	



	$mysqli = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($mysqli->connect_error) {
		print generatePageHTML("Tasks (Error)", generateErrorPageHTML($mysqli->connect_error), $stylesheet);
		exit;
	}

//    $x="hahah";
//
//    if (isset($_POST['China'])) 
//    { 
//        echo "111";
//    }
//
//    if (isset($_POST['Italia'])) 
//    { 
//        echo "2222";
//    }
//
//    if (isset($_POST['Japan'])) 
//    { 
//        $x="Japen"
//    }
//
//    if (isset($_POST['Thailand'])) 
//    { 
//        $x="Thailand"
//    }
//
//    if (isset($_POST['Vietnam'])) 
//    { 
//        $x="Vietnam"
//    }
    
$x=$_POST["Cuisine"];




	$sql = "SELECT * FROM ".$x;
	$result = $mysqli->query($sql);
	$tasks = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			array_push($tasks, $row);
		}
	}
	
	print generatePageHTML("Tasks", generateTaskTableHTML($tasks,$x), $stylesheet);
	
	
	
	function generateTaskTableHTML($tasks,$x) {
        
        if (count($tasks) < 1) {
			$html .= "<p>No Dishes in this food type!</p>\n<p><a class='taskButton' href='createnewtable.php'>+ Add type</a></p>\n";
			return $html;
		}
		$html ="<h1>".$x."</h1>\n";
            
   
		
		$html .= "<p>Here you can add, delete and update dishes </p>\n";
	

		$html .= "<table>\n";
		$html .= "<tr><th>ID</th><th>Menu</th><th>Price</th><th>Ingredients</th><th>Sauce</th></tr>\n";
	
		foreach ($tasks as $task) {
			$ID = $task['ID'];
			$Menu = $task['Menu'];
			$Price = ($task['Price']) ? $task['Price'] : '';
			$Ingredients= $task['Ingredients'];
			$Sauce = ($task['Sauce']) ? $task['Sauce'] : '';
			
			
			$html .= "<tr><td>$ID</td><td>$Menu</td><td>$Price</td><td>$Ingredients</td><td>$Sauce</td></tr>\n";
		}
		$html .= "</table>\n";
        
        
	
		return $html;
	}
	
	function generateErrorPageHTML($error) {
	$html = <<<EOT
<h1>Tasks</h1>
<p>An error occurred: $error</p>
EOT;

	return $html;
	}

?>
<!DOCTYPE html>

<html>
<head></head>
<body>
    <form action='dish_form.php' method='POST'><input type='hidden' name='table' value='<?php print $x; ?>'><input type='submit' value='ADD Dishes'></form>
    <form action='dish_form_delete.php' method='POST'><input type='hidden' name='table' value='<?php print $x; ?>'><input type='submit' value='DELETE Dishes'></form>
    <form action='dish_form_update.php' method='POST'><input type='hidden' name='table' value='<?php print $x; ?>'><input type='submit' value='UPDATE Dishes'></form>
    <a href="adminindex.php">Back</a>
</body>
</html>