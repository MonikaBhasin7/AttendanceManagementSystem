<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
        .square {
            height: 86px;
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
        //echo "In enteri.php";
        $course_id=$_POST["courses"];
        $sub_course_id=$_POST["sub_courses"];
        $semester_no=$_POST["semester_no"];
        $con=connect_db();
        $result=fetch_common_id($con,$course_id,$sub_course_id,$semester_no);
        //Fetching common_id
        while($d=mysqli_fetch_assoc($result))
        {
            $common_id=$d["common_id"];
        }
       ?>
       <center>

        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading"><h2>Show Attendance</h2></div>
            
        </div>
        <div class="square">
          <form action="show_attendance.php" method="post">

           <div class="btn btn-secondary dropdown-toggle">
                <label for="subjects">Select Subject</label>
                <select class="form-control" id="subjects" name="subjects">
                    <option selected="" disabled="">Select Course</option>
                        <?php
                            require 'data.php';
                            $subjects=fetch_subject_list($common_id);
                            foreach ($subjects as $subjecty) {
                                # code...
                                echo "<option id='".$subjecty["subject_id"]."' value='".$subjecty["subject_id"]."'>".$subjecty["subject_id"]."</option>";
                            }
                        ?>
                    
                </select>
            </div>
          
          <br>
           <br>

           <div >
            <input class="btn btn-primary  btny" type="submit" name="submit" value="Submit" >
        </div>
       </form>
        </div>
      </div>
    </center>
       
        
        
    
        
   <?php }?>
</body>
</html>
