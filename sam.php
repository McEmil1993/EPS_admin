<?php

if(isset($_POST['submit'])){
  $name=$_FILES['upload']['name'];
  $size=$_FILES['upload']['size'];
  $type=$_FILES['upload']['type'];
  $temp=$_FILES['upload']['tmp_name'];
  // $caption1=$_POST['caption'];
  // $link=$_POST['link'];
  // $fname = date("YmdHis").'_'.$name;

 $move =  move_uploaded_file($temp,"images/".$name);
 if($move){
  echo "ok";

 }else{
    echo "error";
 }
}
?>