<?php 

include 'connection.php';

if(isset($_POST['submit'])!=""){
  $id = $_POST['id'];
  $name=$_FILES['upload']['name'];
  $size=$_FILES['upload']['size'];
  $type=$_FILES['upload']['type'];
  $temp=$_FILES['upload']['tmp_name'];

 $move =  move_uploaded_file($temp,"../images/".$name);
 if($move){

  $ServerURL="http://localhost/EPS/images/$name";

  $sql = "UPDATE `equipment_tbl` SET `ImageUrl`='$ServerURL' WHERE id ='$id'";

  if ($conn->query($sql)) {

      $_SESSION['success'] = 'update photo';
  } else {
      $_SESSION['error'] = 'Error';
      
  }
 }
 header("Location: ../equipment.php");
}
?>
 ?>