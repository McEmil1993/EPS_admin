<?php

 include 'connection.php';

 if (isset($_POST['submit'])) {
 	$b_id = $_POST['building_id'];
 	$id = $_POST['edit_id'];
 	$name = $_POST['edit_room_name'];
 	$desc = $_POST['edit_description'];

 	$sql = "UPDATE `room_tbl` SET `room_name`='$name', `description`='$desc' WHERE id='$id'";

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'update';
	} else {

  		$_SESSION['error'] = 'Error';
  		
	}
 }
 header("Location: ../room.php?b=".$b_id."");

?>