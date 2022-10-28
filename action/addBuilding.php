<?php

 include 'connection.php';
 $result = "";
 if (isset($_POST['submit'])) {
 	$name = $_POST['building_name'];
 	$desc = $_POST['description'];
 	if (!empty($name) && !empty($desc)) {
 		$sql = "INSERT INTO `building_tbl`( `building_name`, `description`, `count_room`) VALUES ('$name', '$desc', '0')";

		if ($conn->query($sql)) {
			$_SESSION['success'] = 'Add';
		}
		else{
			$_SESSION['error'] = 'Error';
		}
 	}else if (empty($name)){
 		$_SESSION['error'] = 'Please enter building name';
 	}else if (empty($desc)) {
 		$_SESSION['error'] = 'Please enter description';
 	}
 	
 }
 header("Location: ../buildings.php");

?>