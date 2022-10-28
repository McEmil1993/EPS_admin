<?php

 include 'connection.php';

 if (isset($_POST['submit'])) {
 	$id = $_POST['edit_id'];
 	$name = $_POST['edit_task'];
 	$date = $_POST['edit_date'];

 	$sql = "UPDATE `task_tbl` SET `name`='$name', `date_sched`='$date', `sta`='0' WHERE id ='$id' ";

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'update';
	} else {

  		$_SESSION['error'] = 'Error';
  		
	}
 }
 header("Location: ../schedule.php");

?>