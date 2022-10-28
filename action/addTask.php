<?php
		
 include 'connection.php';

 if (isset($_POST['submit'])) {
		$b_id = $_POST['b_id'];
        $r_id = $_POST['r_id'];
        $id = $_POST['e_id'];
        $t_id =$_POST['t_id'];
   
        $sql = "SELECT * FROM checking_tbl WHERE room_id = '$r_id' AND building_id = '$b_id' AND equipment_id = '$id' AND date_time = '0000-00-00 00:00:00' AND status = 0";
        $stmt =  $conn->prepare($sql); 
        $stmt->execute();
        $stmt->store_result();
        $nrows1 = $stmt->num_rows;
        if ($nrows1>0) {
            $_SESSION['error'] = "error";
        }else{
        
            $stmt = $conn->prepare("INSERT INTO `checking_tbl`( `building_id`, `room_id`, `equipment_id`) VALUES (?,?,?)");
            $stmt->bind_param("sss",$b_id,$r_id,$id);
            if ($stmt->execute()== TRUE) {

                $_SESSION['success'] = 'add';

                        $stmt1 = $conn->prepare("UPDATE `equipment_tbl` SET quantity = quantity - 1 WHERE id = ?");
                        $stmt1->bind_param("s",$id);
                        $stmt1->execute();
                       

            }else{
            	$_SESSION['error'] = "Error";
            }

        }
         header("Location: ../task.php?b=".$b_id."&r=".$r_id."&b=".$b_id."&t=".$t_id." ");
}


?>