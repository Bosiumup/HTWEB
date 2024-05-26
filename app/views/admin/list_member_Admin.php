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
}

.disabled {
    background-color: #999 !important;
    border: none;
    cursor: default !important;
}

.button:hover {
    background-color: #45a049;
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
                </tr>
            </thead>
            <tbody>
                <?php
                    // Truy vấn danh sách tiêu chuẩn
                    // $username = $_SESSION['user_name'];
                    $sql = "SELECT * FROM users";
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
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- <div class="button-container">
            <input type="hidden" name="statusEvaluation" value="Đã gửi">
            <button name="sendEvaluation" type="submit" class="button">Gửi đánh giá</button>
        </div> -->
    </form>
</div>

<?php 
    if (isset($_POST['sendEvaluation'])) {
        $evaluation_id = (int) sprintf('%u', hexdec(substr(uniqid(), 8, 13)));
        $username = $_SESSION['user_name'];
        $status = $_POST['statusEvaluation'];
        $sql = "INSERT INTO evaluations (evaluation_id, username, status) values ('$evaluation_id', '$username', '$status')";
        $re_insert_evaluation = $conn->query($sql);
        if($re_insert_evaluation) {
            for ($i = 0; $i < count($_POST['standard_id']); $i++) {
                $standard_id = $_POST['standard_id'][$i];
                $user_ratings = $_POST['user_ratings'][$i];
                $sql = "INSERT INTO detail_evaluation (evaluation_id, standard_id, user_rating) values ('$evaluation_id', '$standard_id', '$user_ratings')";
                $re_insert_detail_evaluation = $conn->query($sql);
                }
                if($re_insert_detail_evaluation) {
                    echo "<script>
                            alert('Send evaluation success');
                            window.location = '?page=detail_table_evaluations';
                        </script>";
                }
            }
    }
?>