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
	include 'database.php';
	$course_id=$_GET["course"];
	$con=connect_db();
	$query="Select * from sub_course where course_id='$course_id'";
	$result=mysqli_query($con,$query);
	//echo"<div class='btn btn-secondary dropdown-toggle'>";
	echo "<label for='sub_courses'>Sub Courses</label>";
	echo "</label>";
	echo"<br>";
	echo "<select class='form-control' id='sub_coursey' name='sub_courses' onchange='getSemester()' >";
	echo "<option value='null'>"; echo "Select"; echo"</option>";
	while($row=mysqli_fetch_array($result))
	{
		echo "<option value=$row[subcourse_id]>"; echo $row["sub_course_name"];echo"</option>";
	}
	echo "</select>";
	//echo "</div>";
?>