<?php 
if (!isset($_SESSION["user_name"])) {
    header("location:index.php");
}
else {
    if (isset($_SESSION['user_name_role']) && $_SESSION['user_name_role'] != "0") {
        header("location:user.php");
    }
}


?>