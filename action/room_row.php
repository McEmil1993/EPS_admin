<?php
include 'connection.php';

 if (isset($_POST['id'])) {
 	$id = $_POST['id'];

 	$sql = "SELECT * FROM `room_tbl` WHERE id = '$id'";

 	$query = $conn->query($sql);
 	$row = $query->fetch_assoc();
 	echo json_encode($row);
	
	$conn->close();
 }
 

?>