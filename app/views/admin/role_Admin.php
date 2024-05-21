<?php 
if (!isset($_SESSION["user_name"])) {
    header("location:index.php");
}
if (isset($_SESSION['user_name_role']) && $_SESSION['user_name_role'] != "0") {
    header("location:index.php");
}
?>