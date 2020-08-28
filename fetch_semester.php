<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</style>
</head>
<body>

</body>
</html>
<?php
	include('database.php');
	$course_id=$_GET["course"];
 
	$con=connect_db();
	$query="Select total_semester from semester where course_id='$course_id'";
	$result=mysqli_query($con,$query);
	$result=mysqli_fetch_object($result);
	//echo $result;
	echo "<label for='semester'>Semester</label>";
	echo"<br>";
	echo "<select class='form-control' id='semester' name='semester_no' onchange='getSubject()'>";
	$i=1;
	echo "<option value='null'>"; echo "Select"; echo"</option>";
	while($i<=$result->total_semester)
	{
		echo "<option>"; echo $i; echo"</option>";
		$i++;
	}
	echo "</select>";
?>