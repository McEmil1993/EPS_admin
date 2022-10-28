<?php

 include 'connection.php';

 if (isset($_POST['submit'])) {
 	$id = $_POST['delete_id'];
 	$b_id = $_POST['building_id'];
 	
 	$sql = "DELETE FROM `room_tbl` WHERE id = '$id'";

	if ($conn->query($sql) === TRUE) {
		$sql1 = "UPDATE building_tbl SET count_room=count_room - 1 WHERE id ='$b_id'";
			if ($conn->query($sql1)) {
				$_SESSION['success'] = 'delete';
			}
	} else {

  		$_SESSION['error'] = 'Error';
  		
	}
 }
 header("Location: ../room.php?b=".$b_id."");


?>