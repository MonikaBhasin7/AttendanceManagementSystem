<?php
require("database.php");
if(!empty($_POST["course_id"])) {

	echo $course_id;
	$con=connect_db();
	$query ="SELECT * FROM sub_course WHERE course_id = '" . $_POST["course_id"] . "'";
	$result=mysqli_query($con,$query);
?>
	<option value="">Select Sub Course</option>
<?php
	foreach($result as $sub_courses) {
?>
	<option value="<?php echo $sub_courses["subcourse_id"]; ?>"><?php echo $sub_courses["sub_course_name"]; ?></option>
<?php
	}
}
?>