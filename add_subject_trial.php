<?php

	//$subject_name=1;
		include('database.php');
		$con=connect_db();
		$result=select_course($con);
		//Fetching common_id
		while($d=mysqli_fetch_assoc($result))
		{
			//$common_id=$d["common_id"];
			echo "<h2>" .$d["course_name"] . "</h2>";
			
		}
?>