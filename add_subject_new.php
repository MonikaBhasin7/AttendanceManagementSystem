<?php
	session_start();
	include('database.php');
	if(isset($_POST["submit"]))
	{
		//echo "In enter.php";
		$course_id=$_POST["courses"];
		$sub_course_id=$_POST["sub_courses"];
		$semester_no=$_POST["semester_no"];
		$subject_id=$_POST["subject_id"];
		$subject_name=$_POST["subject_name"];
		
		$con=connect_db();
		$result=fetch_common_id($con,$course_id,$sub_course_id,$semester_no);
		//Fetching common_id
		while($d=mysqli_fetch_assoc($result))
		{
			$common_id=$d["common_id"];
			echo "<h2>" .$d["common_id"] . "</h2>";
			
		}
		$data=add_into_subject($con,$common_id,$subject_id,$subject_name);

		//Need a change
		//$result=make_subject_count($con,$subject_id);
		header("Location: add_subject.php");
   		exit;
		
	}
?>