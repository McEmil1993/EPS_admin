<?php

 include 'connection.php';

 if (isset($_POST['submit'])) {
 	$id = $_POST['edit_id'];
 	$name = $_POST['edit_cate'];
 	$desc = $_POST['edit_task'];

 	$sql = "UPDATE `category_tbl` SET `cate_name`='$name', `Task`='$desc' WHERE id='$id'";

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'update';
	} else {

  		$_SESSION['error'] = 'Error';
  		
	}
 }
 header("Location: ../category.php");

?>