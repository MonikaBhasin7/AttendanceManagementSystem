<?php
//session_start();
function connect_db()
{
	$con=mysqli_connect("localhost","root","","attendancesystemmanagement");
	if(!$con)
	{
		echo "Error Connecting to Database";
	}
	return $con;
}
function select_course($con)
{
	$query="Select * from course";
	$result=mysqli_query($con,$query);
	return $result;
	//return false;
}
function fetch_common_id($con,$course_idy,$sub_course_idy,$semester_noy)
{
	$query="Select common_id from making_common where (course_id=$course_idy && sub_course_id=$sub_course_idy && semester_no=$semester_noy)";
	$result=mysqli_query($con,$query);
	return $result;
	//return false;
}
function fetch_common_id_from_subject_table($con,$subject_idy)
{
	$query="SELECT common_id from subject WHERE subject_id='$subject_idy'";
	$result=mysqli_query($con,$query);
	//echo $result;
	return $result;
	//return false;
}
function add_into_subject($con,$common_idy,$subject_id,$subject_name)
{
	$query="SELECT subject_id FROM subject WHERE subject_id='$subject_id'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result) == 0) {
		//Row not Found
		$_SESSION["error_adding_subject"]="0";//No Error
	     $query1="insert into subject
		(common_id,subject_id,subject_name) values ('$common_idy',
		'$subject_id','$subject_name')";
		$result1=mysqli_query($con,$query1);
		if(mysqli_affected_rows($con))
		{
			echo "Data Enteredi";
			return true;
		}
		return false;
	}
	else {
    	// do other stuff...
    	//Row Found
    	echo "Row found";
    	$_SESSION["error_adding_subject"]="1";//Error
	}
}
function add_into_student($con,$common_idy,$rollno,$name)
{
	$query="SELECT rollno FROM student WHERE rollno=' $rollno'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result) == 0) {
		//Row not Found
		$_SESSION["error_adding_student"]="0";//No Error
	     $query1="insert into student
		(common_id,rollno,name) values ('$common_idy','$rollno',
		'$name')";
		$result1=mysqli_query($con,$query1);
		if(mysqli_affected_rows($con))
		{
			echo "Data Enteredi";
			return true;
		}
		return false;
	}
	else {
    	// do other stuff...
    	//Row Found
    	echo "Row found";
    	$_SESSION["error_adding_student"]="1";//Error
	}
	
}
function fetch_student($con,$common_id)
{
	$query="Select * from student where (common_id=$common_id)";
	$result=mysqli_query($con,$query);
	return $result;
	//return false;
}
function fetch_present_student($con,$subject_id,$day,$month,$year)
{
	$query="Select * from attendance where (subject_id='$subject_id' && day='$day' && month='$month' && year='$year')";
	$result=mysqli_query($con,$query);
	return $result;
}
function take_attendance($con,$subject_id,$day,$month,$year,$rollno)
{
	$query="insert into attendance
	(subject_id,day,month,year,rollno) values ('$subject_id','$day',
	'$month','$year','$rollno')";

	$result=mysqli_query($con,$query);

	if(mysqli_affected_rows($con))
	{
		echo "Data Enteredi";
		return true;
	}
	else
	{
		echo "Not Entered";
		return false;
	}
	
}
function delete_attendance($con,$subject_idy,$day,$month,$year)
{
	$query="Select count(*) as count  from attendance";
	$sqls=mysqli_query($con,$query);
	$res = mysqli_fetch_assoc($sqls);

	$number=$res['count'];
	echo $number;

	$sql = "DELETE FROM attendance WHERE subject_id='$subject_idy' AND day=$day AND month=$month AND year=$year";

	if (mysqli_query($con, $sql)) {
	    echo "Record deleted successfully";
	    $query1="Select count(*) as count  from attendance";
		$sqls1=mysqli_query($con,$query1);
		$res = mysqli_fetch_assoc($sqls1);
		$number1=$res['count'];
		echo $number1;
	} else {
	    echo "Error deleting record: " . mysqli_error($con);
	}

	$difference=$number-$number1;
	return $difference;

	
}
function increase_attendance($con,$subject_id)
{
	$query="Select count from Subjectcount  WHERE subject_id='$subject_id'";
	$result=mysqli_query($con,$query);
	//echo '$result';

	$res = mysqli_fetch_assoc($result);
	$number=$res['count'];
	$number=$number+1;
	//echo "Number->".$number;
	$sql = "UPDATE Subjectcount SET count=$number WHERE subject_id='$subject_id'";

	if (mysqli_query($con, $sql)) {
    	//echo "Record updated successfully";
	} else {
    echo "Error updating record: " . mysqli_error($con);
	}
}

function check_attendance_count($con,$subject_id,$year,$month)
{
	$query="Select count(year) from subjectcount where (subject_id='$subject_id' && 
			year='$year' && month='$month')";
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_array($result);
	//echo $row[0];
	return $row[0];
}
function make_subject_count($con,$subject_id)
{
	$query="insert into subjectcount
	(subject_id,count) values ('$subject_id',0)";

	$result=mysqli_query($con,$query);

	if(mysqli_affected_rows($con))
	{
		//echo "Data Enteredi";
		return true;
	}
	return false;
}
function select_student($con,$common_id)
{
	$query="Select * from student where common_id=$common_id ORDER BY rollno";
	$result=mysqli_query($con,$query);
	return $result;
	//return false;
}
function fetch_whole_attendance($con,$subject_id,$rollno)
{
	$query="Select count(*) as count  from attendance where subject_id='$subject_id' && rollno=$rollno";
	$sqls=mysqli_query($con,$query);
	$res = mysqli_fetch_assoc($sqls);

	$number=$res['count'];
	return $number;
}
function fetch_attendance_whole_year_per_person($con,$subject_id,$rollno,$years)
{
	$query="Select count(*) as count  from attendance where subject_id='$subject_id' && rollno=$rollno && year=$years";
	$sqls=mysqli_query($con,$query);
	$res = mysqli_fetch_assoc($sqls);

	$number=$res['count'];
	return $number;
}
function fetch_attendance_monthwise_per_person($con,$subject_id,$rollno,$years,$months)
{

	$query="Select count(*) as count  from attendance where subject_id='$subject_id' && rollno=$rollno && year=$years && month=$months";
	$sqls=mysqli_query($con,$query);
	$res = mysqli_fetch_assoc($sqls);

	$number=$res['count'];
	return $number;
}
/*function fetch_subject_list($con,$common_idy)
{
	$query="Select subject_id from subject where (common_id=$common_idy)";
	$result=mysqli_query($con,$query);
	return $result;
}*/
?>