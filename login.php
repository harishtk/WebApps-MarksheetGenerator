<?php

	require('MarksheetGenerator.php');
	
	/*if ( $_POST['username'] ) {
		header ('Location: staff_mark_entry.html');
		exit;
	}*/
    
	$con = mysqli_connect('localhost', 'root', 'hellosql', 'student');
	
	if ( !$con ) {
		echo "Error connecting to server: ".mysqli_connect_error();
		exit;
	}
	
	$reg_no = $_POST['reg_no'];
	$course_title = array();
	$ia = array();
	$ee = array();
	$student_name = '';
	$program = '';
	$dob = '';
	$sem = '';
	$mon_year_of_exam = '';
	
	if ( !$reg_no ) {
		echo "Error: Input required";
		exit;
	}
	
	$result = mysqli_query($con, "SELECT COUNT(*) FROM result_record WHERE reg_no = ".$reg_no);
	
	if ( !$result ) {
		echo "Error: ".mysqli_errno($con);
		exit;
	}
	
	$row = mysqli_fetch_array($result);
	
	if ( $row[0] == 0 ) {
		echo "Student Record not found on Server!";
		exit;
	}
		
	$result = mysqli_query($con, "SELECT * FROM stud_info WHERE reg_no = ".$reg_no);
	
	if ( $result ) 
		$row = mysqli_fetch_array($result);
	
	if ( $row ) {
		$student_name = $row['name'];
		$dob = $row['dob'];
		$program = $row['dept'];
		$sem = $row['sem'];
		$mon_year_of_exam = $row['yoe'];
	}
	
	$result = mysqli_query($con, "SELECT * FROM marks WHERE reg_no = ".$reg_no);
	
	if ( $result ) {

		while ( $row = mysqli_fetch_assoc($result) ) {
			array_push($course_title, $row['c_name']);
			array_push($ia, $row['ia']);
			array_push($ee, $row['ee']);
		}
	}
	
	if ( $reg_no && $student_name && $dob && $sem && $program && $mon_year_of_exam && $course_title && $ia && $ee ) {
		$this.generatePDF($reg_no, $student_name, $dob, $sem, $program, $mon_year_of_exam, $course_title, $ia, $ee);
	}
		
	
	
	
	
?>