<?php

 include 'connection.php';

 if (isset($_POST['submit'])) {
 	$id = $_POST['delete_id'];
 	
 	$sql = "DELETE FROM `building_tbl` WHERE id = '$id'";

	if ($conn->query($sql) === TRUE) {
		$_SESSION['success'] = 'delete';
	} else {

  		$_SESSION['error'] = 'Error';
  		
	}
 }
 header("Location: ../buildings.php");


?>