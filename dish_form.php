<?php
    $x=$_POST['table'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Task Manager</title>
<link rel="stylesheet" type="text/css" href="taskmanager.css">
</head>
<body>

<h1><?php print $x; ?></h1>
<form action="add_dish.php" method="post">
    <p>Menu<br />
  <input type="text" name="Menu" value="" placeholder="Name" maxlength="20" size="20"></p>
    <p>Price<br />
  <select name="Price">
	  <option value="5">$5</option>
	  <option value="6">$6</option>
	  <option value="7">$7</option>
      <option value="8">$8</option>
      <option value="9">$9</option>
      <option value="10">$10</option>
      <option value="11">$11</option>
      <option value="12">$12</option>  
  </select>
  </p>
  <p>Ingredients<br/>
  <input type="text" name="Ingredients" value="" placeholder="Food type" maxlength="20" size="50"></p>
  <p>Sauce<br/>
   <input type="text" name="Sauce" value="" placeholder="Sauce type" maxlength="20" size="50"></p>
    <input type="hidden" name="Table" value="<?php print $x; ?>">
    <input type="submit" value="Submit">
</form>

</body>
</html>