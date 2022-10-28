<?php

 include 'connection.php';

 	$username = $_POST['username'];
 	$password = $_POST['password'];

 	$sql = "SELECT * FROM `users_tbl` WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
                    
        $row = $result->fetch_assoc();

        if ($row['password'] == $password) {
        	echo '1';
        }else{
        	echo '2';
        }

    }else{
    	echo '0';
    }
 

?>