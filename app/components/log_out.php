<?php
    if (isset($_POST['logout'])) {
        $username = $_SESSION['user_name'];
        $sql = "SELECT * FROM users WHERE username='$username'";
        $account = $conn->query($sql);
        if ($account->num_rows > 0) {
            $row = $account->fetch_assoc();
            if ($row["role"] == "0") {
                session_destroy();
                header("location: index.php");
            }
            else {
                session_destroy();
                header("location: index.php");
            } 
        }
    }