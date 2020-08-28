<?php
session_start();
$_SESSION["error_adding_student"]="0";
$_SESSION["error_adding_subject"]="0";
?>
<html>

<head>
	<style>
		.square {
  			height: 240px;
  			width: 240px;
  			background-color: #ccd9ff;
  			margin-top: 100px;
		}
		.btny
		{
			height: 35px;
  			width: 130px;
		}

</style>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script type="text/javascript">
  	function to_add_subject() {
    	window.location = "http://localhost/AttendanceSystemManagement/add_subject.php";
  	}
  	function to_add_student() {
    	window.location = "http://localhost/AttendanceSystemManagement/add_student.php ";
  	}
  	function take_attendance() {
    	window.location = "http://localhost/AttendanceSystemManagement/take_attendance_subject_list.php";
  	}
  	function show_attendance_list()
  	{
  		window.location = "http://localhost/AttendanceSystemManagement/show_attendance_list.php";
  	}
	</script>

	<link rel="stylesheet" type="text/css" href="public/style.css">

</head>

<body>

	<center>

		<div class="panel-group">
    		<div class="panel panel-info">
      			<div class="panel-heading"><h1>Attendance Management System</h1></div>
      		
    	</div>

	<div class="square">
		
		<br>
	
	<button id="show_button" class="btn btn-primary  btny" class="panel-body" onclick="to_add_subject()" >
			Add Subject
	</button>
	<br>
	<br>

	<button id="show_button" class="btn btn-primary  btny"  class="panel-body"onclick="to_add_student()" >
			Add Student
	</button>

	<br>
	<br>

	<button id="show_button" class="btn btn-primary"  class="panel-body"onclick="take_attendance()" >
			Take Attendance
	</button>
	<br>
	<br>

	<button id="show_button" class="btn btn-primary"  class="panel-body"onclick="show_attendance_list()" >
			Show Attendance
	</button>
	<br>
	<br>
	
	</div>
	</center>
	

	


	

	





</body>
</html>