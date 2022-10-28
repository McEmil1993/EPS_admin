<?php

 include 'connection.php';
 $result = "";
 if (isset($_POST['submit'])) {
 	$id = $_POST['building_id'];
 	$name = $_POST['room_name'];
 	$desc = $_POST['description'];
 	if (!empty($name) && !empty($desc)) {
 		$sql = "INSERT INTO `room_tbl`(building_id,`room_name`, `description`) VALUES ('$id', '$name', '$desc')";

		if ($conn->query($sql)) {
			$sql1 = "UPDATE building_tbl SET count_room=count_room + 1 WHERE id ='$id'";
			if ($conn->query($sql1)) {
				$_SESSION['success'] = 'Add';
			}
		}
		else{
			$_SESSION['error'] = 'Error';
		}
 	}else if (empty($name)){
 		$_SESSION['error'] = 'Please enter room name';
 	}else if (empty($desc)) {
 		$_SESSION['error'] = 'Please enter description';
 	}
 	
 }

 header("Location: ../room.php?b=".$id."");

?>