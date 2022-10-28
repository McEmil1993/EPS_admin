<?php

 include 'connection.php';
 $result = "";
 if (isset($_POST['submit'])) {
 	$name = $_POST['cate_name'];
 	$task = $_POST['task'];
 	if (!empty($name) && !empty($task)) {
 		$sql = "INSERT INTO `category_tbl`(`cate_name`, `Task`) VALUES  ('$name', '$task')";

		if ($conn->query($sql)) {

			$_SESSION['success'] = 'Add';
		}
		else{
			$_SESSION['error'] = 'Error';
		}
 	}else if (empty($name)){
 		$_SESSION['error'] = 'Please Enter category';
 	}else if (empty($task)) {
 		$_SESSION['error'] = 'Please Enter task';
 	}
 	
 }
 header("Location: ../category.php");

?>