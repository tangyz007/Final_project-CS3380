<?php
	require ('db_credentials.php');

    $connect= mysqli_connect($servername,$username,$password ,$dbname);
     $x=$_POST['table'];
    $query = "SELECT * FROM ".$x;
    
    $result1 = mysqli_query($connect,$query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Task Manager</title>
<link rel="stylesheet" type="text/css" href="taskmanager.css">
</head>
<body>

<h1><?php print $x; ?></h1>
<p>Please choose a dish to update its price</p>


 <form action="update_dish.php" method="post">
   

 <select name="dish">

        <?php $i=1;while($row1 = mysqli_fetch_array($result1)):;?>
        <option value="<?php echo $row1[ID]; ?>"><?php echo $row1[Menu]; ?></option>
        <?php endwhile; ?>

</select>
     <input type="hidden" name="table" value='<?php print $x; ?>'>
     <p>Please choose a new Price<br/>
  <select name="change">
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
     <input type="submit" value="Submit">
    </form>
</body>
</html>