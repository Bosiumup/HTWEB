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
    <h1>Danh sách tiêu chuẩn</h1>
    <form style="padding-bottom: 20px;" method="post" action="?page=detail_table_evaluations">
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
                    <th><button type="submit">Sửa</button></th>
                    <th><button type="submit">Xóa</button></th>
                </tr>
            </thead>
            <tbody>
                <?php      
                $criteria_sql = "SELECT * FROM criteria WHERE standard_id = " . $standard_row['standard_id'];
                $criteria_result = mysqli_query($conn, $criteria_sql);
                if (mysqli_num_rows($criteria_result) > 0) {
                    while ($criteria_row = mysqli_fetch_assoc($criteria_result)) {
                    ?>
                <tr>
                    <td><?php echo $criteria_row['criteria_name']; ?></td>
                    <td><?php echo $criteria_row['points']; ?></td>
                    <td>
                        <button type="submit">Sửa</button>
                    </td>
                    <td>
                        <button type="submit">Xóa</button>
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

        ?>
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
                            alert('Gửi đánh giá thành công');
                            window.location = '?page=detail_table_evaluations';
                        </script>";
                }
            }
    }
?>