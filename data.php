<?php 
	require 'DbConnect.php';
	function loadCourses() {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM course");
		$stmt->execute();
		$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $courses;
	}

	function loadMonths() {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM month");
		$stmt->execute();
		$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $courses;
	}

	function loadYears() {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM year");
		$stmt->execute();
		$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $courses;
	}
	
	function loadSubCourses() {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM sub_course");
		$stmt->execute();
		$sub_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $sub_courses;
	}

	function fetch_subject_list($common_idy) {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT subject_id from subject where (subject.common_id=$common_idy)");
		$stmt->execute();
		$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $subjects;
	}
 ?>