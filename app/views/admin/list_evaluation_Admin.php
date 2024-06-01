<style>
/* Thiết kế giao diện */
.container {
    width: 1000px;
    max-width: 100%;
    height: 100vh;
    padding: 20px 0;
}

.container>span {
    display: block;
    font-size: large;
    margin-bottom: 5px;
}

.container>span span {
    color: #fffa00;
}

h1 {
    font-weight: 500;
    text-align: center;
    padding: 20px 0;
}

h2 {
    margin-top: 20px;
}

.form-css {
    display: flex;
    flex-wrap: wrap;
    padding-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #f2f2f2;
    margin-top: 20px;
    border-radius: 10px;
}

th {
    font-size: large;
}

th,
td {
    padding: 15px 20px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:last-child td {
    border: 0;
}

td img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
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
    border-radius: 5px;
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
    border-radius: 10px;
}

.button-disable {
    background-color: #74b0e2;
    border-color: #74b0e2;
    font-size: small;
    padding: 5px 10px !important;
    height: unset !important;
    margin: 0 !important;
}

.button-del {
    background-color: #ff3131 !important;
    border-color: #ff3131 !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}
</style>

<div class="container">
    <h1>Danh sách đánh giá tiêu chuẩn</h1>
    <div class="list-quantity">
        <div class="pass">
            <h2>Danh sách đã gửi (cần đánh giá)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND e.status = 'Đã gửi'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td>
                            <a style="color: red;"
                                href="?page=detail_evaluation_Admin&id=<?php echo $row['evaluation_id']; ?>&status=Đã gửi"><?php echo $row['evaluation_id']; ?>
                            </a>
                        </td>
                        <td><?php echo $row['username']; ?></td>
                        <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <form action="?page=list_evaluation_Admin" method="post">
                                <input type="hidden" name="evaluation_id" value="<?php echo $row['evaluation_id'] ?>">
                                <button class="button" type="submit" name="btnDelete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="wait-result">
            <h2>Danh sách chờ kết quả</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND e.status = 'Chờ kết quả'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td>
                            <a style="color: red;"
                                href="?page=detail_evaluation_Admin&id=<?php echo $row['evaluation_id']; ?>&status=Chờ kết quả"><?php echo $row['evaluation_id']; ?>
                            </a>
                        </td>
                        <td><?php echo $row['username']; ?></td>
                        <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <form action="?page=list_evaluation_Admin" method="post">
                                <input type="hidden" name="evaluation_id" value="<?php echo $row['evaluation_id'] ?>">
                                <button class="button" type="submit" name="btnDelete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="no-pass">
            <h2>Danh sách đã đánh giá</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND e.status = 'Đã đánh giá'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td>
                            <a style="color: green;"
                                href="?page=detail_evaluation_Admin&id=<?php echo $row['evaluation_id']; ?>&status=Đã đánh giá"><?php echo $row['evaluation_id']; ?>
                            </a>
                        </td>
                        <td><?php echo $row['username']; ?></td>
                        <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <form action="?page=list_evaluation_Admin" method="post">
                                <input type="hidden" name="evaluation_id" value="<?php echo $row['evaluation_id'] ?>">
                                <button class="button" type="submit" name="btnDelete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
    if (isset($_POST['btnDelete'])) {
        $evaluation_id = $_POST['evaluation_id'];
        $sql_detail_evaluation = "DELETE FROM detail_evaluation WHERE evaluation_id = '$evaluation_id'";
        $conn->query($sql_detail_evaluation);
        $sql = "DELETE FROM evaluations WHERE evaluation_id = '$evaluation_id'";
        $conn->query($sql);
        echo "<script>
                alert('Xóa thành công.');
                window.location = '?page=list_evaluation_Admin';
            </script>";
    }
?>