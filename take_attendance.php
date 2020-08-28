<?php
session_start();
include 'database.php';
	if(isset($_POST["submit"]))
	{
		$con=connect_db();
		$chk=$_POST["chk"];
		$suby=$_SESSION["select_subject"];
		//echo $suby;
		$day=$_SESSION["day"];
		$month=$_SESSION["month"];
		$year=$_SESSION["year"];

		echo $day;
		echo $month;
		echo $year;

		if($suby!="0")
		{
			$difference=delete_attendance($con,$suby,$day,$month,$year);
			if($difference==0)
			{
				$result=check_attendance_count($con,$suby,$year,$month);
				echo "---".$result;

				if($result==0)   //No row found whose year=year and subject_id=subject_id
				{

					$query="insert into subjectcount
					(subject_id,year,month,count) values ('$suby','$year','$month',1)";

					$result=mysqli_query($con,$query);

					if(mysqli_affected_rows($con))
					{
						echo "Data Enteredi";
		
					}
				}

				else if($result!=0)    //Row found, so only have to update that row.
				{
					$query="SELECT count from subjectcount where (subject_id='$suby' && year='$year' && month='$month')";
					$result=mysqli_query($con,$query);
					$row=mysqli_fetch_array($result);
					$county = $row[0];


					$query="UPDATE subjectcount set count=($county+1) where (subject_id='$suby' && year='$year' && month='$month')";
					$result=mysqli_query($con,$query);

				}

			}
			/*if($difference==0)
			{
				//means no record exists in the attendance table
				increase_attendance($con,$suby);
			}*/
			//echo $suby;
			foreach ($chk as $chky) {
				# code...
			
				echo $chky;
				//Take Attendance- Adding Attendance in the Table.
				take_attendance($con,$suby,$day,$month,$year,$chky);
			}

			$_SESSION["select_subject"]="0";
			$_SESSION["day"]=0;
			$_SESSION["month"]=0;
			$_SESSION["year"]=0;
			header("Location: take_attendance_subject_list.php");
   			exit;
		}
		


	}
?>