<?php
	include 'database.php';
	$course_id=$_GET["course"];
	$sub_course_id=$_GET["sub_course"];
	$semester_id=$_GET["semester"];


	$con=connect_db();

	//Extracting common_id from $course_id,$sub_course_id, $semester_id
	$query="Select common_id from making_common where (course_id='$course_id' && sub_course_id='$sub_course_id' && semester_no='$semester_id')";
	$result=mysqli_query($con,$query);
	while($d=mysqli_fetch_assoc($result))
		{
			$common_id=$d["common_id"];
			//echo "<h2>" .$d["common_id"] . "</h2>";
			
		}
	/*$result=mysqli_query($con,$query);
	$result=mysqli_fetch_field($result);
	$result=(string)$result;*/

	$query1="Select * from subject where common_id='$common_id'";
	$result1=mysqli_query($con,$query1);


	echo "<label for='for-subject'>Subject</label>";
	echo "</label>";
	echo"<br>";
	echo "<select class='form-control' id='subject' name='subjects'>";
	echo "<option value='null'>"; echo "Select"; echo"</option>";
	while($row=mysqli_fetch_array($result1))
	{
		echo "<option value=$row[subject_id]>"; echo $row["subject_name"];echo"</option>";
	}
	echo "</select>";
	
?>