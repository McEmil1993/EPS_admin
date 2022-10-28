<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['full_name']);
session_destroy();
header("location: login.php");
?>