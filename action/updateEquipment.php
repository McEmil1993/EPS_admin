<?php
include 'connection.php';
if (isset($_POST['submit'])) {

            $id = $_POST['edit_id'];

            $name = $_POST['name'];
            $description = $_POST['description'];
            $cate_name = $_POST['category'];
            $quantity = $_POST['quantity'];
            $status = 0;

           

            $stmt = $conn->prepare("UPDATE equipment_tbl SET category_id =?, name=?, description=? ,quantity=?,status=? WHERE id =?");
            $stmt->bind_param("ssssss", $cate_name,$name,$description,$quantity,$status,$id);
            $result = array();
            if($stmt->execute()===TRUE){
                $_SESSION['success'] = 'update';
               
              
            }else{
                 $_SESSION['error'] = 'Error';
            }
            $stmt->close();
            $conn->close();
        }
header("Location: ../equipment.php");

?>