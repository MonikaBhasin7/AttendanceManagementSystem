<!DOCTYPE html>
<html>
<head>
	<title>Show Attendance</title>
	<style>
        .square {
            height: 25px;
            width: 250px;
            background-color: #99bbff;
            margin-top: 30px;
        }
       
        .btny
        {
            height: 35px;
            width: 130px;
        }

        .btnytextbox
        {
            height: 35px;
            width: 180px;
        }

        .table_css {
  		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  		border-collapse: collapse;
  		width: 36%;
		}

		.table_css td, .table_css th {
  		border: 1px solid #ddd;
  		padding: 8px;
		}

		

		.table_css th {
  		padding-top: 12px;
  		padding-bottom: 12px;
  		text-align: left;
  		background-color: #4CAF50;
  		color: white;
		}

        

</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
		
		<?php
		include 'database.php';
		if(isset($_POST["submit"]))
	    {

	    	$course_id=$_POST["courses"];
        	$sub_course_id=$_POST["sub_courses"];
        	$semester_no=$_POST["semester_no"];
	        $sub=$_POST["subjects"];
	        $months=$_POST["months"];
	        $years=$_POST["years"];

			//Fetch common_id from Subject
	        $con=connect_db();
	        if($months==0 && $years!=0)
			{
				$query="SELECT SUM(count) as total from subjectcount where
				 (subject_id='$sub' && year='$years') ";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				$total_county=$row['total'];
				//echo '--'.$row['total'];
			}
			else if($months!=0 && $years!=0)
			{
				$query="SELECT SUM(count) as total from subjectcount where
				 (subject_id='$sub' && year='$years' && month='$months') ";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				$total_county=$row['total'];
				//echo '--'.$row['total'];;
			}


	        
			$result=fetch_common_id_from_subject_table($con,$sub);
			//echo $result;
			while($d=mysqli_fetch_assoc($result))
			{
				$common_id=$d["common_id"];
				//echo "<h2>" .$d["common_id"] . "</h2>";
				
			}
			$result=select_student($con,$common_id);?>
			<center>
			<div class="panel-group">
            <div class="panel panel-info">
               <div class="panel-heading"><h2>Show Attendance</h2></div>
            </div>

            <div class="square">
            	<h5>Total Lectures Delivered - <?php echo"$total_county"?></h5>
            </div>
		</center>
			<table  border="1" align="center" class="table_css">
	        	<td>Rollno</td>
	        	<td>Name</td>
	        	<td>Count</td>
	        	<td>Percentage</td>
	        		
					<?php
					while($d=mysqli_fetch_assoc($result))
					{?>
						<tr class="active">
							<td><?php echo $d["rollno"]?></td>
							<td><?php echo $d["name"]?></td>
							<?php
								if($months==0 && $years!=0)
								{
									$data=fetch_attendance_whole_year_per_person($con,$sub,$d["rollno"],$years);
								}
								else if($months!=0 && $years!=0)
								{
									$data=fetch_attendance_monthwise_per_person($con,$sub,$d["rollno"],$years,$months);
								}
								//$data=fetch_whole_attendance($con,$sub,$d["rollno"]);
							?>
							<td><?php echo $data ?></td>
							<?php

								if($total_county==0)
								{
									throw new Exception("Value must be 1 or below");
								}
								else
								{
									$percent=$data/$total_county;
									$percent=$percent*100;
								}

								
							?>
							<td><?php echo $percent ?>%</td>
						</tr>
					<?php
					}
					?>
			</table>




			<?php

			}

			?>
</body>
</html>