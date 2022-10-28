<?php

 include 'connection.php';


 	$id = $_POST['id'];
 	$status = $_POST['status'];

 	$sql = "UPDATE `checking_tbl` SET date_time=NOW() ,status='$status' , name_f='".$_SESSION['user_name']."' WHERE id ='$id' ";

	if ($conn->query($sql)) {
		echo  'update';
	} else {
  		echo  'error';
  		
	}
 


?>