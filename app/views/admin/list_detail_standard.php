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
    <h1>Danh sách tiêu chuẩn</h1>

    <!-- ------------------ Thêm  -->
    <button class="button" id="SdOpenFormAdd" type="button">Thêm tiêu chuẩn</button>
    <div id="SdMyModalAdd" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Thêm tiêu chuẩn</h2>
            <form style="width: 100%; display: inline-block;" action="?page=list_detail_standard" method="POST">
                <label>
                    <span>Tên tiêu chuẩn</span>
                    <input type="text" name="standardName" placeholder="...">
                </label>
                <label>
                    <span>Điểm tiêu chuẩn</span>
                    <input class="select" type="number" name="standardPoint" max="100" min="1">
                </label>
                <button class="mb-0 button" name="standardAdd" type="submit">Thêm</button>
            </form>
        </div>
    </div>
    <a class="button" href="admin.php">Trang admin</a>

    <!-- ------------------ Danh sách tiêu chuẩn  -->
    <table>
        <thead>
            <tr>
                <th style="text-align: justify;">Tên tiêu chuẩn</th>
                <th>Điểm</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
        // Truy vấn danh sách tiêu chuẩn
        $standard_sql = "SELECT * FROM standards";
        $standard_result = mysqli_query($conn, $standard_sql);
        if (mysqli_num_rows($standard_result) > 0) {
            $i = 0;
            while ($standard_row = mysqli_fetch_assoc($standard_result)) {
                $i++;
                ?>

            <tr class="row-d">
                <td style="text-align: justify;">
                    <a href="?page=list_detail_criteria&standard_ID=<?php echo $standard_row['standard_id']; ?>">
                        <?php echo '<span style="font-weight: 600;">Tiêu chuẩn ' . $i . '</span>' . ". " . $standard_row['standard_name']; ?>
                    </a>
                </td>
                <td><?php echo $standard_row['points']; ?></td>
                <td>
                    <input type="hidden" class="sdPresentID" value="<?php echo $standard_row['standard_id']; ?>">
                    <input type="hidden" class="sdPresentName" value="<?php echo $standard_row['standard_name']; ?>">
                    <input type="hidden" class="sdPresentPoint" value="<?php echo $standard_row['points']; ?>">
                    <button class="button-disable button SdOpenFormUpdate" type="button">Sửa</button>
                </td>
                <td>
                    <form method="post" action="?page=list_detail_standard">
                        <input type="hidden" name="sdID" value="<?php echo $standard_row['standard_id']; ?>">
                        <button class="button-disable button-del button" name="standardDelete"
                            type="submit">Xóa</button>
                    </form>
                </td>
            </tr>

            <?php
            }
        }
        ?>
        </tbody>
    </table>

    <div id="sdMyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Cập nhật tiêu chuẩn</h2>
            <form style="width: 100%; display: inline-block;" action="?page=list_detail_standard" method="POST">
                <input type="hidden" id="sdOldID" name="standardNID">
                <label>
                    <span>Tên tiêu chuẩn</span>
                    <input type="text" id="sdFormName" name="standardNewName">
                </label>
                <label>
                    <span>Điểm tiêu chuẩn</span>
                    <input type="text" id="sdFormPoint" name="standardNewPoint">
                </label>
                <button class="mb-0 button" name="standardUpdate" type="submit">Cập nhật</button>
            </form>
        </div>
    </div>
</div>


<?php 
    // ------------------ Thêm 
    if (isset($_POST['standardAdd'])) {
        $standardName = trim($_POST['standardName']);
        $standardPoint = $_POST['standardPoint'];
        if(empty($standardName)) {
            echo "<script>
                    alert('Không được để trống.');
                    window.location = '?page=list_detail_standard';
                </script>";
        }
        else {
            $check_add = "SELECT * FROM standards WHERE standard_name = '$standardName'";
            if($conn->query($check_add)->num_rows > 0) {
                echo "<script>
                        alert('Đã có tiêu chuẩn $standardName.');
                        window.location = '?page=list_detail_standard';
                    </script>";
            } else {
                // Kiểm tra tổng điểm của tất cả tiêu chuẩn
                $total_standard_points_sql = "SELECT SUM(points) as total_points FROM standards";
                $total_standard_point_result = $conn->query($total_standard_points_sql);
                $total_standard_point_row = mysqli_fetch_assoc($total_standard_point_result);
                $total_standard_points = $total_standard_point_row['total_points'] + $standardPoint;

                // Kiểm tra nếu tổng điểm vượt quá 100
                if ($total_standard_points > 100) {
                    echo "<script>
                            alert('Tổng số điểm của các tiêu chuẩn không được vượt quá 100 điểm!');
                            window.location = '?page=list_detail_standard';
                        </script>";
                } else {
                    $sql = "INSERT INTO standards (standard_name, points) values ('$standardName', '$standardPoint')";
                    $re_insert_evaluation = $conn->query($sql);
                    echo "<script>
                            alert('Thêm thành công.');
                            window.location = '?page=list_detail_standard';
                        </script>";
                }
            }
        }
    }

    // ------------------ Cập nhật
    if (isset($_POST['standardUpdate'])) {
        $standardNID = $_POST['standardNID'];
        $standardNewName = $_POST['standardNewName'];
        $standardNewPoint = (int)$_POST['standardNewPoint'];
        $check_update = "SELECT * FROM standards WHERE standard_name = '$standardNewName' AND standard_id != '$standardNID'";
        if($conn->query($check_update)->num_rows > 0) {
            echo "<script>
                    alert('Đã có tiêu chuẩn $standardNewName.');
                    window.location = '?page=list_detail_standard';
                </script>";
        } else {
            // Lấy điểm của tiêu chuẩn hiện tại
            $current_standard_points_sql = "SELECT points FROM standards WHERE standard_id = '$standardNID'";
            $current_standard_point_result = $conn->query($current_standard_points_sql);
            $current_standard_point_row = mysqli_fetch_assoc($current_standard_point_result);
            $current_standard_point = $current_standard_point_row['points'];

            // Tính tổng điểm của tất cả tiêu chuẩn
            $total_standard_points_sql = "SELECT SUM(points) as total_points FROM standards";
            $total_standard_point_result = $conn->query($total_standard_points_sql);
            $total_standard_point_row = mysqli_fetch_assoc($total_standard_point_result);
            $total_standard_points = $total_standard_point_row['total_points'] - $current_standard_point + $standardNewPoint;

            // Kiểm tra nếu tổng điểm vượt quá 100
            if ($total_standard_points > 100) {
                echo "<script>
                        alert('Tổng số điểm của các tiêu chuẩn không được vượt quá 100 điểm!');
                        window.location = '?page=list_detail_standard';
                    </script>";
            } else {
                $sql = "UPDATE standards SET standard_name = '$standardNewName', points = '$standardNewPoint' WHERE standard_id = '$standardNID'";
                $conn->query($sql);
                echo "<script>
                        alert('Cập nhật thành công.');
                        window.location = '?page=list_detail_standard';
                    </script>";
            }
        }
    }
    
    // ------------------ Xóa 
    if (isset($_POST['standardDelete'])) {
        $standardID = $_POST['sdID'];
        $sql_criteria = "DELETE FROM criteria WHERE standard_id = '$standardID'";
        $conn->query($sql_criteria);
        $sql = "DELETE FROM standards WHERE standard_id = '$standardID'";
        $conn->query($sql);
        echo "<script>
                alert('Xóa thành công.');
                window.location = '?page=list_detail_standard';
            </script>";
    }
?>
<script src="app/js/standard/add.js"></script>
<script src="app/js/standard/update.js"></script>