<div class="container-register">
    <div class="title">Register</div>
    <div class="content">
        <form action="?page=register_User" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Username</span>
                    <input name="username" type="text" placeholder="Enter your Username" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input name="pass" type="password" placeholder="Enter your Password" required>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input name="confirm-pass" type="password" placeholder="Enter your Confirm Password" required>
                </div>
                <div class="input-box">
                    <span class="details">Name</span>
                    <input value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" name="name-user"
                        type="text" placeholder="Enter your Name" required>
                </div>
                <div class="input-box">
                    <span class="details">Birth Year</span>
                    <input value="<?php echo isset($_SESSION['birth_year']) ? $_SESSION['birth_year'] : '' ?>"
                        name="birth_year" type="number" placeholder="Enter your Birth Year" required>
                </div>
                <div class="input-box">
                    <span class="details">Hometown</span>
                    <input value="<?php echo isset($_SESSION['hometown']) ? $_SESSION['hometown'] : '' ?>"
                        name="hometown" type="text" placeholder="Enter your Hometown" required>
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">Gender</span>
                <input type="radio" name="gender" value="Male"
                    <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') echo 'checked'; ?> required>
                <span>Male</span>
                <input type="radio" name="gender" value="Female"
                    <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') echo 'checked'; ?>
                    required> <span>Female</span>
            </div>

            <!-- role : 1 -> user -->
            <input type="hidden" name="role" value="1">

            <div class="button">
                <input name="register" type="submit">
            </div>
        </form>
        <a href="?page=log_in_User">Login now</a>
    </div>
</div>

<?php
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["register"])) {
    $user_name = $_POST['username'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm-pass'];
    $name = $_POST['name-user'];
    $birth_year = $_POST['birth_year'];
    $hometown = $_POST['hometown'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    $_SESSION['name'] = $_POST['name-user'];
    $_SESSION['birth_year'] = $_POST['birth_year'];
    $_SESSION['hometown'] = $_POST['hometown'];
    $_SESSION['gender'] = $_POST['gender'];

    // Kiểm tra xem username và tên đã tồn tại chưa
    $check_query = "SELECT * FROM users WHERE username = '$user_name'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "<script>
                      alert('Username combination already exists');
                        window.location = '?page=register_User';
                    </script>";
    } else {
        if (password_verify($confirm_password, $password)) {
            $sql = "INSERT INTO users (username, password, name, gender, birth_year, hometown, role) values ('$user_name', '$password', '$name', '$gender', '$birth_year', '$hometown', '$role')";

            if ($conn->query($sql)) {
                echo "<script>
                      alert('New account successfully');
                        window.location = '?page=log_in_User';
                    </script>";
            }
        } else {
            echo "<script>
                      alert('Password and Confirm Password do not match');
                        window.location = '?page=register_User';
                    </script>";
        }
    }
}
?>