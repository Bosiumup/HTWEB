<style>
/* Thiết kế giao diện */
.container {
    max-width: 1500px;
    padding: 20px;
}

.list-quantity {
    display: flex;
}

.pass {
    padding-right: 50px;
}

h1 {
    font-weight: 500;
    text-align: center;
    padding: 40px 0;
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
    <h1>Danh sách thống kê kết quả</h1>
    <div class="list-quantity">
        <div class="pass">
            <h2>Danh sách đạt</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Kết quả</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND e.pass = 'Đạt'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td><?php echo $row['evaluation_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td style="color: green"><?php echo $row['pass']; ?></td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="no-pass">
            <h2>Danh sách không đạt</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Kết quả</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND e.pass = 'Không đạt'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách hội viên
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td><?php echo $row['evaluation_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><img src="<?php echo $row['avatar_url']; ?>" alt="avatar"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td style="color: red"><?php echo $row['pass']; ?></td>
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