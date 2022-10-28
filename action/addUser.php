<?php

 include 'connection.php';
 $result = "";
 if (isset($_POST['submit'])) {
 	$fullname = $_POST['fullname'];
 	$contact = $_POST['contact'];
 	$address = $_POST['address'];
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	$user_type = $_POST['user_type'];

 		$sql = "INSERT INTO `users_tbl`(`fullname`, `contact`, `address`, `username`, `password`, `user_type`) VALUES ('$fullname', '$contact', '$address', '$username', '$password', '$user_type')";

		if ($conn->query($sql)) {
			$_SESSION['success'] = 'add';
		}
		else{
			$_SESSION['error'] = 'Error';
		}
 	
 	
 }
 header("Location: ../users.php");

?>