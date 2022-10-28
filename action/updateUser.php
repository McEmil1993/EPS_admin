<?php

 include 'connection.php';
 $result = "";
 if (isset($_POST['submit'])) {
 	$id = $_POST['id'];
 	$fullname = $_POST['fullname'];
 	$contact = $_POST['contact'];
 	$address = $_POST['address'];
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	$user_type = $_POST['user_type'];

 	if ($user_type == "") {
 		$sql = "UPDATE `users_tbl` SET `fullname`='$fullname', `contact`='$contact', `address`='$address', `username`='$username', `password`='$password' WHERE id ='$id' ";

		if ($conn->query($sql)) {
			$_SESSION['success'] = 'update';
		}
		else{
			$_SESSION['error'] = 'Error';
		}
 		header("Location: ../profile.php");
 	}else{
 		$sql = "UPDATE `users_tbl` SET `fullname`='$fullname', `contact`='$contact', `address`='$address', `username`='$username', `password`='$password', `user_type`='$user_type' WHERE id ='$id' ";

		if ($conn->query($sql)) {
			$_SESSION['success'] = 'update';
		}
		else{
			$_SESSION['error'] = 'Error';
		}
		 header("Location: ../users.php");
 	}
 	
 }


?>