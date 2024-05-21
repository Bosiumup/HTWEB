<style>
/* Thiết kế giao diện */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
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
    text-align: left;
    border-bottom: 1px solid #ddd;
}

td {
    text-align: center;
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
    <h2>Bảng đánh giá tiêu chuẩn</h2>
    <?php 
    $username = $_SESSION['user_name'];
    $sql = "SELECT * FROM evaluations WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row["status"];
        ?>
    <span>Trạng thái: <?php echo $status; ?></span>
    <?php
    }
    ?>

    <form method="post" action="?page=detail_table_evaluations">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu chuẩn</th>
                    <th>Điểm số</th>
                    <th>Đánh giá của Hội viên</th>
                    <th>Đánh giá của Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Truy vấn danh sách tiêu chuẩn
                    $sql = "SELECT * FROM standards s, detail_evaluation de, evaluations e WHERE s.standard_id = de.standard_id AND de.evaluation_id = e.evaluation_id AND e.username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    // Hiển thị danh sách tiêu chuẩn
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                <tr>
                    <td>
                        <input type="hidden" name="standard_id[]" value="<?php echo $row['standard_id']; ?>">
                        <span><?php echo $row['standard_id']; ?></span>
                    </td>
                    <td><?php echo $row['standard_name']; ?></td>
                    <td><?php echo $row['points']; ?></td>
                    <td>
                        <?php 
                            if($row['status'] == "Đã đánh giá" || $row['status'] == "Đã xem") {
                                ?>
                        <span><?php echo $row['user_rating']; ?></span>
                        <?php        
                            }
                            else {
                                ?>
                        <select class="select" name="user_ratings[]">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <span><?php echo $row['admin_rating']; ?></span>
                    </td>
                </tr>
                <?php
                    }
                }
                else {
                    $sql = "SELECT * FROM standards";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                <tr>
                    <td>
                        <input type="hidden" name="standard_id[]" value="<?php echo $row['standard_id']; ?>">
                        <span><?php echo $row['standard_id']; ?></span>
                    </td>
                    <td><?php echo $row['standard_name']; ?></td>
                    <td><?php echo $row['points']; ?></td>
                    <td>
                        <select class="select" name="user_ratings[]">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </td>
                    <td>
                        <!-- <span><?php echo $row['admin_rating']; ?></span> -->
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>


        <div class="button-container">
            <?php
           $sql = "SELECT * FROM evaluations WHERE username = '$username'";
           $result_status = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result_status) > 0) {
        $row_status = mysqli_fetch_assoc($result_status);
        if ($row_status['status'] == "Đã đánh giá" || $row_status['status'] == "Đã xem") {
            ?>
            <button name="sendEvaluation" type="submit" class="button disabled" disabled>Gửi đánh giá</button>
            <?php
        } else {
            ?>
            <input type="hidden" name="statusEvaluation" value="Đã gửi">
            <button name="sendEvaluation" type="submit" class="button">Gửi đánh giá</button>
            <?php
        }
    }
    else {
        ?>
            <input type="hidden" name="statusEvaluation" value="Đã gửi">
            <button name="sendEvaluation" type="submit" class="button">Gửi đánh giá</button>
            <?php
    }
    ?>
        </div>
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