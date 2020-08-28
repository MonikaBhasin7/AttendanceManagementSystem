<!DOCTYPE html>
<html>
<head>
    </script>
	<title>Take Attendance</title>
	<style>
        .square {
            height: 76px;
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

    session_start();
	include('database.php');
        $course_id=$_POST["courses"];
        $sub_course_id=$_POST["sub_courses"];
        $semester_no=$_POST["semester_no"];
        $subject_id=$_POST["subjects"];
        if(isset($_POST["submit"]))
        {
            $datepicky = date('d-m-Y', strtotime($_POST["datepickery"]));
            //echo $datepicky;
            $datepicky = explode('-', $datepicky);
            $day=$datepicky[0];
            $month=$datepicky[1];
            $year=$datepicky[2];

            $_SESSION["day"]=$day;
            $_SESSION["month"]=$month;
            $_SESSION["year"]=$year;
            //echo $day;
            //echo $month;
            //echo $year;
        }

       

        
		//$subject_id="BTCS101";
		//$subject_name=1;
        //echo $course_id;
        //echo $sub_course_id;
        //echo $semester_no;
        //echo $subject_id;
		$con=connect_db();
		$result=fetch_common_id($con,$course_id,$sub_course_id,$semester_no);
		//Fetching common_id
		while($d=mysqli_fetch_assoc($result))
		{
			$common_id=$d["common_id"];
			//echo "<h2>" .$d["common_id"] . "</h2>";
			
		}
?>
		
        <div type="hidden">
        	
        	<?php
        		$con=connect_db();
        	    $result=fetch_student($con,$common_id);
                
                $result1=fetch_present_student($con,$subject_id,$day,$month,$year);
                $selected_subject_array[0]=1;
                while($d=mysqli_fetch_array($result1))
                {
                    $selected_subject_array[]=$d['rollno'];
                }
                //echo $selected_subject_array;
        	?>

        	<center>

                <form role="form" method="post" action="take_attendance.php">

        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading"><h2>Take Attendance</h2></div>
        
                <br>
                <br>

                <table border="1" align="center" class="table_css">
                    <td>Rollno</td>
                    <td>Name</td>
                    <td><input type="submit" class="btn btn-primary value="Check" name="submit"></td>
                
                    <?php
                    //Start Subject Session
                    $_SESSION["select_subject"]=$subject_id;
                    while($d=mysqli_fetch_assoc($result))
                    {?>
                        <tr class="active">
                        <td><?php echo $d["rollno"]?></td>
                        <td><?php echo $d["name"]?></td>
                        <?php
                            $checked=-1;
                            $checked=array_search($d["rollno"],
                                $selected_subject_array);
                            //echo $checked;

                        ?>
                        
                        <td><input type="checkbox" name="chk[]" value ="<?php echo $d["rollno"]?>" <?php if($checked>-1) { echo 'checked'; }?>></td>

                        </tr>
                        <?php
                    }
                    
                    ?>
                </table>
            </form>
                <?php}
            ?>


        	</div>

            
        
            

        	
        </div>
		</center>
        	
        	
        </div>
        
    
</body>
</html>