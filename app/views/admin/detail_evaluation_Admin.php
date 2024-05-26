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

.button-container a {
    margin-right: 10px;
    background-color: #fff;
    padding: 10px 20px;
}

.button-container a:hover {
    opacity: 0.9;
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
    $get_evaluation_id = isset($_GET['id']) ? $_GET['id'] : '';
    $get_status = isset($_GET['status']) ? $_GET['status'] : '';
    $sql = "SELECT * FROM users u, evaluations e WHERE u.username = e.username AND e.evaluation_id = '$get_evaluation_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $status = $row["status"];
        $pass = $row["pass"];
        $sql_total = "SELECT SUM(admin_rating) AS total_admin_rating FROM detail_evaluation de, evaluations e WHERE e.evaluation_id = de.evaluation_id AND e.evaluation_id='$get_evaluation_id'";
        $result_total = $conn->query($sql_total);
        if ($result_total->num_rows > 0) {
            $row_total = $result_total->fetch_assoc();
            $total = $row_total["total_admin_rating"];
        }
        ?>
    <span>Tên: <span><?php echo $name; ?></span> </span>
    <span>Trạng thái: <span><?php echo $status; ?></span> </span>
    <span>Số điểm: <span><?php echo $total; ?>/100</span> </span>

    <?php
        if($get_status == 'Đã đánh giá') {
            ?>
    <span>Kết quả: <span><?php echo $pass; ?></span> </span>
    <?php
        }
        elseif($status == 'Chờ kết quả') {
            ?>
    <form action="?page=detail_evaluation_Admin&id=<?php echo $get_evaluation_id ?>&status=<?php echo $get_status ?>"
        method="post">
        <input type="hidden" name="statusEvaluationPass" value="Đã đánh giá">
        <select class="select" name="pass" required>
            <option>Chọn điểm</option>
            <option value="Đạt">Đạt</option>
            <option value="Không đạt">Không đạt</option>
        </select>
        <button name="sendPass" type="submit" class="button">Gửi kết quả</button>
    </form>
    <?php
    if (isset($_POST['sendPass'])) {
        $status_pass = $_POST['statusEvaluationPass'];
        $pass_select = $_POST['pass'];
        $sql = "UPDATE evaluations SET status = '$status_pass', pass = '$pass_select' WHERE evaluation_id = '$get_evaluation_id'";
        $re_insert_pass = $conn->query($sql);
        if($re_insert_pass) {
            echo "<script>
                    alert('Đã gửi kết quả');
                    window.location = '?page=detail_evaluation_Admin&id=$get_evaluation_id&status=$status_pass';
    </script>";
    }
    }
    }
    }
    ?>

    <form method="post"
        action="?page=detail_evaluation_Admin&id=<?php echo $get_evaluation_id ?>&status=<?php echo $get_status ?>">
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
                        if($get_status == 'Đã đánh giá') {
                            // Truy vấn danh sách tiêu chí cho tiêu chuẩn
                            $criteria_sql = "SELECT * FROM criteria c, detail_evaluation de, evaluations e WHERE e.evaluation_id = de.evaluation_id AND c.criteria_id = de.criteria_id AND e.evaluation_id = '$get_evaluation_id' AND c.standard_id = " . $standard_row['standard_id'];
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
                        }
                        else {
                            $criteria_sql = "SELECT * FROM criteria c, detail_evaluation de, evaluations e WHERE e.evaluation_id = de.evaluation_id AND c.criteria_id = de.criteria_id AND e.evaluation_id = '$get_evaluation_id' AND c.standard_id = " . $standard_row['standard_id'];
                        $criteria_result = mysqli_query($conn, $criteria_sql);
                        if (mysqli_num_rows($criteria_result) > 0) {
                            while ($criteria_row = mysqli_fetch_assoc($criteria_result)) {
                                ?>
                <tr>
                    <td><?php echo $criteria_row['criteria_name']; ?></td>
                    <td><?php echo $criteria_row['points']; ?></td>
                    <td><?php echo $criteria_row['user_rating']; ?></td>
                    <td>
                        <?php 
                            if($criteria_row['status'] == 'Chờ kết quả') {
                                ?>
                        <span><?php echo $criteria_row['admin_rating']; ?></span>
                        <?php
                            }
                            elseif($criteria_row['status'] == 'Đã gửi') {
                                ?>
                        <input type="hidden" name="criteria_id[]" value="<?php echo $criteria_row['criteria_id']; ?>">
                        <select class="select" name="admin_ratings[]" required>
                            <option value="">Chọn điểm</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <?php
                            }
                        ?>
                    </td>
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
    if ($get_status == 'Đã đánh giá' || $get_status == 'Chờ kết quả') {
            ?>
            <a href="?page=list_evaluation_Admin">Về trang quản lý danh sách đánh giá</a>
            <button name="sendEvaluation" type="submit" class="button disabled" disabled>Gửi đánh giá</button>
            <?php
        
    }
    else {
        ?>
            <input type="hidden" name="statusEvaluation" value="Chờ kết quả">
            <button name="sendEvaluation" type="submit" class="button">Gửi đánh giá</button>
            <?php
    }
    ?>
        </div>
    </form>
</div>

<?php 
    if (isset($_POST['sendEvaluation'])) {
        $status = $_POST['statusEvaluation'];
        $sql = "UPDATE evaluations SET status = '$status' WHERE evaluation_id = '$get_evaluation_id'";
        $re_update_evaluation = $conn->query($sql);
        if($re_update_evaluation) {
            for ($i = 0; $i < count($_POST['criteria_id']); $i++) {
                $admin_ratings = $_POST['admin_ratings'][$i];
                $sql = "UPDATE detail_evaluation SET admin_rating = '$admin_ratings' WHERE evaluation_id = '$get_evaluation_id'";
                $re_update_detail_evaluation = $conn->query($sql);
                }
                if($re_update_detail_evaluation) {
                    echo "<script>
                            alert('Đã đánh giá');
                            window.location = '?page=detail_evaluation_Admin&id=$get_evaluation_id&status=$status';
</script>";
}
}
    }
?>