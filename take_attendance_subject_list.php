<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="j_query/jquery-ui.min.css">
    <title>Take Attendance</title>
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
            document.getElementById("semestery").innerHTML=xmlhttp.responseText;
        }
        function getSubject()
        {
            //alert("Value Come");
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","fetch_subject.php?course="+document.getElementById("courses").value+"&sub_course="+document.getElementById("sub_coursey").value+"&semester="+document.getElementById("semester").value,false);
            xmlhttp.send(null);
            document.getElementById("subjectry").innerHTML=xmlhttp.responseText;
            //alert("Value Come");
        }
</script>
    <style>
        .square {
            height: 320px;
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
            top: 30px;
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
                     <a href="enter_page.php" id="back_button" title="Login"><img src="left-arrow.png" width="22" height="22""/></a><h2>Take Attendance</h2></div>
            
        </div>
        <div class="square">
           <br>
           <form role="form"  method="post" action="take_attendance_subject_list_new.php">
        

            <div class=" btn btn-secondary dropdown-toggle">
                <label for="courses">Course Name</label>
                <select onchange="getSubCourse()" class="form-control" id="courses" name="courses" 
                onChange="getState(this.value);>
                    <option value="">Select Course</option>
                        <?php
                            require 'data.php';
                            echo "<option value='null'>"; echo "Select"; echo"</option>";
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
            
            
        <div class="btn btn-secondary dropdown-toggle" id="semestery">
                <label for="semester">Semester</label>
                    <select class="form-control" id="semester-list">
                        <option>Select</option>
                    </select>
            </div>
        

        <br>

        <div class="btn btn-secondary dropdown-toggle" id="subjectry">
                <label for="subject">Subject</label>
                    <select class="form-control" id="subject_list">
                        <option>Select</option>
                    </select>
        </div>


        <div class="textbox  row  btn btn-secondary dropdown-toggle">
            <div class="col-25">
                <label for="datepickery">Date</label>
            </div>
            <div class="col-75">
                <input type="date" size="40" name="datepickery" class=" form-control btny">
            </div>
        </div>
        <br>
        <br>
        
        <div class="row">
            <input type="submit" class="btn btn-primary  btny" name="submit" value="Submit" >
        </div>
      
        
    </form>
       </div>
   </div>
</center>
     
<script src="j_query/jquery-3.3.1.min.js"></script>
    <script src="j_query/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#datepicker').datepicker({
                dateFormat:"dd-mm-yy",
                changeMonth:true,
                changeYear:true
            });
        })
    </script>
</body>
</html>
<?php
include('database.php');
?>