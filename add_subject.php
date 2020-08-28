<?php
session_start();
include('database.php');
if($_SESSION["error_adding_subject"]=="1")
{
    echo '<script language="javascript">';
    echo 'alert("Subject already exists")';
    echo '</script>';
    $_SESSION["error_adding_subject"]="0";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Subject</title>
    <script type="text/javascript">
        history.pushState(null,null,location.href);
        window.onpopstate=function()
        {
            history.go(1);
        };
    </script>
    <script>
        function getSubCourse() {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","fetch_subcourse.php?course="+document.getElementById("courses").value,false);
            xmlhttp.send(null);
            //alert(xmlhttp.responseText);
            document.getElementById("sub_course").innerHTML=xmlhttp.responseText;
        }
        function getSemester()
        {
            //alert(document.getElementById("sub_coursey").value);
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","fetch_semester.php?course="+document.getElementById("courses").value,false);
            xmlhttp.send(null);
            //alert(xmlhttp.responseText);
            document.getElementById("semester").innerHTML=xmlhttp.responseText;
        }
    </script>

    <style>
        .square {
            height: 400px;
            width: 250px;
            background-color: #99bbff;
            margin-top: 30px;
        }
       
        .btny
        {
            height: 35px;
            width: 130px;
        }
        #back_button
        {
            position: absolute;
            top: 50px;
            left: 30px;
            font-size: 18px;
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
    <center>
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <a href="enter_page.php" id="back_button" title="Login"><img src="left-arrow.png" width="22" height="22""/></a><h2>Add Subject</h2></div>
            </div>
        </div>

        <div class="square">
            <br>
            <form role="form" method="post" action="add_subject_new.php">
        
            <div class=" btn btn-secondary dropdown-toggle">
                <label for="courses">Course Name</label>
                <select onchange="getSubCourse()" class="form-control" id="courses" name="courses" 
                onChange="getState(this.value);>
                    <option value="">Select Course</option>
                        <?php
                            require 'data.php';
                            $courses=loadCourses();
                            foreach ($courses as $coursey) {
                                # code...
                                echo "<option id='".$coursey["course_id"]."' value='".$coursey["course_id"]."'>".$coursey["course_name"]."</option>";
                            }
                        ?>
                    
                </select>
            </div>

            <div class="btn btn-secondary dropdown-toggle" id="sub_course">
                <label for="sub_courses">Sub Courses</label>
                    <select class="form-control" id="subcourse-list">
                        <option>Select</option>
                    </select>
            </div>

            
            <br>
            
        <div class="btn btn-secondary dropdown-toggle" id="semester">
                <label for="semester">Semester</label>
                    <select class="form-control" id="semester">
                        <option>Select</option>
                    </select>
            </div>

        <div class="textbox row btn btn-secondary dropdown-toggle">
            <div class="col-25">
                <label for="name">Subject Id</label>
            </div>
            <div class="col-75">
                <input type="integer" class="form-control btnytextbox" name="subject_id">
            </div>
        </div>

        <div class="textbox row btn btn-secondary dropdown-toggle">
            <div class="col-25">
                <label for="name">Subject Name</label>
            </div>
            <div class="col-75">
                <input type="integer" class="form-control btnytextbox" name="subject_name">
            </div>
        </div>
        
        <br>
        <br>

        <div >
            <input class="btn btn-primary  btny" type="submit" name="submit" value="Submit" >
        </div>
      
        
    </form>
        </div>
            
        
    </center>
    

</body>
</html>