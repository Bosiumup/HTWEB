<style>
/* Thiết kế giao diện */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-weight: 500;
    text-align: center;
    padding: 40px 0 20px;
    text-transform: Uppercase;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #f2f2f2;
    margin-top: 20px;
    border-radius: 10px;
}

th,
td {
    padding: 15px 20px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

td img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

tr:last-child td {
    border: 0;
}

.button-container {
    text-align: center;
    margin-top: 20px;
}

.button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: 1px solid #45a049;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.1s linear;
}

.disabled {
    background-color: #999 !important;
    border: none;
    cursor: default !important;
}

.button:hover {
    opacity: 0.9 !important;
    transform: scale(1.05);
}

.disabled:hover {
    background-color: transparent;
}

.select {
    padding: 0 10px;
    font-size: medium;
}
</style>

<div class="container">
    <h1>Danh sách hội viên</h1>
    <form method="post" action="?page=list_member_Admin">
        <table>
            <thead>
                <tr>
                    <th>Tài khoản</th>
                    <th>Hình ảnh</th>
                    <th>Tên</th>
                    <th>Giới tính</th>
                    <th>Năm sinh</th>
                    <th>Quê quán</th>
                    <th>Loại tài khoản</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Truy vấn danh sách tiêu chuẩn
                    // $username = $_SESSION['user_name'];
                    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND u.role = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['birth_year']; ?></td>
                    <td><?php echo $row['hometown']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <form action="?page=list_member_Admin" method="post">
                            <input type="hidden" name="usernameDelete" value="<?php echo $row['username'] ?>">
                            <input type="hidden" name="evaluation_id" value="<?php echo $row['evaluation_id'] ?>">
                            <button class="button" type="submit" name="btnDelete">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                }
                else {
                    $sql = "SELECT * FROM users WHERE role = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['birth_year']; ?></td>
                    <td><?php echo $row['hometown']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <form action="?page=list_member_Admin" method="post">
                            <input type="hidden" name="usernameDelete" value="<?php echo $row['username'] ?>">
                            <button class="button" type="submit" name="btnDeleteUser">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
            }
        }
                ?>
            </tbody>
        </table>
    </form>
</div>

<?php 
    if (isset($_POST['btnDelete'])) {
        $usernameDelete = $_POST['usernameDelete'];
        $evaluation_id = $_POST['evaluation_id'];
        $sql_detail_evaluation = "DELETE FROM detail_evaluation WHERE evaluation_id = '$evaluation_id'";
        $conn->query($sql_detail_evaluation);
        $sql = "DELETE FROM evaluations WHERE evaluation_id = '$evaluation_id'";
        $conn->query($sql);
        $sql = "DELETE FROM users WHERE username = '$usernameDelete'";
        $conn->query($sql);
        echo "<script>
                alert('Xóa thành công.');
                window.location = '?page=list_member_Admin';
            </script>";
    }
    elseif (isset($_POST['btnDeleteUser'])) {
        $usernameDelete = $_POST['usernameDelete'];
        $sql = "DELETE FROM users WHERE username = '$usernameDelete'";
        $conn->query($sql);
        echo "<script>
                alert('Xóa thành công.');
                window.location = '?page=list_member_Admin';
            </script>";
    }
?>