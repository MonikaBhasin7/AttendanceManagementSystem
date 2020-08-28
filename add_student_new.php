<?php
	// Start the session
	session_start();
	include('database.php');
	if(isset($_POST["submit"]))
	{
		//echo "In enteri.php";
		$course_id=$_POST["courses"];
		$sub_course_id=$_POST["sub_courses"];
		$semester_no=$_POST["semester_no"];
		$rollno=$_POST["rollno"];
		$name=$_POST["name"];
		
		/*$subject_id="BTCS101";
		$subject_name=1;
		echo "<h2>" .$course_id . "</h2>";
		echo "<h2>" .$sub_course_id . "</h2>";
		echo "<h2>" .$semester_no . "</h2>";
		echo "<h2>" .$rollno . "</h2>";
		echo "<h2>" .$name . "</h2>";*/
		if(!empty($course_id) || !empty($sub_course_id) || !empty($semester_no) 
			|| !empty($rollno) || !empty($name))
		{
			$con=connect_db();
		$result=fetch_common_id($con,$course_id,$sub_course_id,$semester_no);
		//Fetching common_id
		while($d=mysqli_fetch_assoc($result))
		{
			$common_id=$d["common_id"];
			echo "<h2>" .$d["common_id"] . "</h2>";
			
		}
		$data=add_into_student($con,$common_id,$rollno,$name);
		//echo $_SESSION["error_adding_student"];
		header("Location: add_student.php");
   		exit;
		}
		
	
		
	}
?>