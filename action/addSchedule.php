<?php

 include 'connection.php';
 $result = "";
 if (isset($_POST['submit'])) {
 	$name = $_POST['task'];
 	$date = $_POST['date-of-birth'];
 	if (!empty($name) && !empty($date)) {
 		$sql = "INSERT INTO `task_tbl`(`name`, `date_sched`, `sta`) VALUES ('$name', '$date', '0')";

		if ($conn->query($sql)) {

			$_SESSION['success'] = 'Add';
		}
		else{
			$_SESSION['error'] = 'Error';
		}
 	}else if (empty($name)){
 		$_SESSION['error'] = 'Please Enter Task';
 	}else if (empty($date)) {
 		$_SESSION['error'] = 'Please Enter date';
 	}
 	
 }
 header("Location: ../schedule.php");

?>