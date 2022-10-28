<?php
include 'connection.php';
if (isset($_POST['submit'])) {
    // code... 
  $fname=$_FILES['upload']['name'];
  $temp=$_FILES['upload']['tmp_name'];

        $move =  move_uploaded_file($temp,"../images/".$fname);
        if($move){
            $name = $_POST['name'];
            $description = $_POST['description'];
            $cate_name = $_POST['category'];
            $quantity = $_POST['quantity'];
            $status = 0;

            $ServerURL="http://localhost/EPS/images/$fname";

            $stmt = $conn->prepare("INSERT INTO equipment_tbl(category_id, name, description, ImageUrl,quantity,status) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $cate_name,$name,$description,$ServerURL,$quantity,$status);
            $result = array();
            if($stmt->execute()==TRUE){
                $_SESSION['success'] = 'Add';
              
            }else{
                 $_SESSION['error'] = 'Error';
            }
            $stmt->close();
            $conn->close();
        }else{
            $_SESSION['error'] = 'Image not uploaded';
        }
}
header("Location: ../equipment.php");

?>