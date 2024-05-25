<style>
/* Thiết kế giao diện */
.container {
    height: 100vh;
    padding: 20px 0;
}

.wrap {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}

h1 {
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
    border-radius: 10px;
}
</style>

<div class="container">
    <h1>Bảng đánh giá tiêu chuẩn</h1>
    <?php 
    $username = $_SESSION['user_name'];
    $sql = "SELECT * FROM evaluations WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row["status"];
        $pass = $row["pass"];
        $sql_total = "SELECT SUM(admin_rating) AS total_admin_rating FROM detail_evaluation de, evaluations e WHERE e.evaluation_id = de.evaluation_id AND username='$username'";
        $result_total = $conn->query($sql_total);
        if ($result_total->num_rows > 0) {
            $row_total = $result_total->fetch_assoc();
            $total = $row_total["total_admin_rating"];
        }
        ?>
    <span>Trạng thái: <span><?php echo $status; ?></span> </span>
    <span>Số điểm: <span><?php echo $total; ?></span> </span>
    <span>Kết quả: <span><?php echo $pass; ?></span> </span>
    <?php
        
    }
    ?>

    <form method="post" action="?page=detail_table_evaluations">
        <?php
        // Truy vấn danh sách tiêu chuẩn
        $standard_sql = "SELECT * FROM standards";
        $standard_result = mysqli_query($conn, $standard_sql);
        if (mysqli_num_rows($standard_result) > 0) {
            while ($standard_row = mysqli_fetch_assoc($standard_result)) {
                ?>

        <table>
            <thead>
                <tr>
                    <th><?php echo $standard_row['standard_name']; ?></th>
                    <th>Điểm số: <?php echo $standard_row['points']; ?></th>
                    <th>Đánh giá của Hội viên</th>
                    <th>Đánh giá của Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            // Truy vấn danh sách tiêu chí cho tiêu chuẩn
                            $criteria_sql = "SELECT * FROM criteria c, detail_evaluation de, evaluations e WHERE e.evaluation_id = de.evaluation_id AND c.criteria_id = de.criteria_id AND e.username = '$username' AND c.standard_id = " . $standard_row['standard_id'];
                            $criteria_result = mysqli_query($conn, $criteria_sql);
                            if (mysqli_num_rows($criteria_result) > 0) {
                                while ($criteria_row = mysqli_fetch_assoc($criteria_result)) {
                                    ?>
                <tr>
                    <td><?php echo $criteria_row['criteria_name']; ?></td>
                    <td><?php echo $criteria_row['points']; ?></td>
                    <td>
                        <span><?php echo $criteria_row['user_rating']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $criteria_row['admin_rating']; ?></span>
                    </td>
                </tr>
                <?php
                                }
                            }
                            else {
                                $criteria_sql = "SELECT * FROM criteria WHERE standard_id = " . $standard_row['standard_id'];
                            $criteria_result = mysqli_query($conn, $criteria_sql);
                            if (mysqli_num_rows($criteria_result) > 0) {
                                while ($criteria_row = mysqli_fetch_assoc($criteria_result)) {
                                    ?>
                <tr>
                    <td><?php echo $criteria_row['criteria_name']; ?></td>
                    <td><?php echo $criteria_row['points']; ?></td>
                    <td>
                        <input type="hidden" name="standard_id[]" value="<?php echo $criteria_row['standard_id']; ?>">
                        <input type="hidden" name="criteria_id[]" value="<?php echo $criteria_row['criteria_id']; ?>">
                        <select class="select" name="user_ratings[]" required>
                            <option value="">Chọn điểm</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <?php
                                }
                            }
                        
                            }
                        ?>
            </tbody>
        </table>
        <?php
            }
        }
        ?>


        <div class="button-container">
            <?php
           $sql = "SELECT * FROM evaluations WHERE username = '$username'";
           $result_status = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result_status) > 0) {
            ?>
            <button name="sendEvaluation" type="submit" class="button disabled" disabled>Gửi đánh giá</button>
            <?php
        
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
            for ($i = 0; $i < count($_POST['criteria_id']); $i++) {
                $standard_id = $_POST['standard_id'][$i];
                $criteria_id = $_POST['criteria_id'][$i];
                $user_ratings = $_POST['user_ratings'][$i];
                $sql = "INSERT INTO detail_evaluation (evaluation_id, standard_id, criteria_id, user_rating) values ('$evaluation_id', '$standard_id', '$criteria_id', '$user_ratings')";
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