<?php

 include 'connection.php';

 if (isset($_POST['submit'])) {
 	$id = $_POST['edit_id'];
 	$name = $_POST['edit_building_name'];
 	$date = $_POST['edit_description'];

 	$sql = "UPDATE `building_tbl` SET `building_name`='$name', `description`='$date' WHERE id ='$id' ";

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'update';
	} else {

  		$_SESSION['error'] = 'Error';
  		
	}
 }
 header("Location: ../buildings.php");

?>