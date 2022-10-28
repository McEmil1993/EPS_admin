<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eps_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
    $password = $_POST['password'];
// if (isset($_POST['submit'])) {
if (empty($username)) {
    echo "3";
}elseif (empty($password)) {
    echo "4";
}else{
    $sql = "SELECT * FROM `users_tbl` WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
                    
        $row = $result->fetch_assoc();

        if ($row['password'] == $password) {

            
            $result1 = $conn->query("SELECT * FROM `photo_tbl` WHERE user_id = '".$row['id']."'");
            $row1 = $result1->fetch_assoc();


            $_SESSION['admin'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['img_url'] = $row1['filename'];
            $_SESSION['role'] = $row['user_type'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];

            echo "1";
        }else{
            echo "2";
        }
         

    }else{
        echo "0";
    }
}
   

    
// }



?>