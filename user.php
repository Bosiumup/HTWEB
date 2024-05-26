<?php 
session_start();
require "app/config/cloudinary.php";
require "app/config/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học phần Hệ Thống Web</title>
    <link rel="stylesheet" href="public/styles/base.css">
    <link rel="stylesheet" href="public/styles/register.css">
    <link rel="stylesheet" href="public/styles/inf_user.css">
</head>

<body>
    <main class="Membership_Management_app">
        <?php
            if (isset($_GET["page"])) {
              $p = $_GET["page"]; //pages/$p."php"
              require "app/views/user/".$p.".php";
            } 
            else {
              require "app/views/user/layouts/detail_User.php";
            }
          ?>
    </main>
</body>

</html>