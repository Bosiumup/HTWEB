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
    <?php 
        $get_standard_ID = isset($_GET['standard_ID']) ? $_GET['standard_ID'] : '';
        $sql_standard = "SELECT * FROM standards WHERE standard_id = '$get_standard_ID'";
        if (mysqli_num_rows($conn->query($sql_standard)) > 0) {
            $row_standard = $conn->query($sql_standard)->fetch_assoc();
            $standard_Name = $row_standard["standard_name"];
            $standard_Point = $row_standard["points"];
            ?>
    <h1>Bảng tiêu chuẩn <?php echo $standard_Name ?></h1>

    <!-- ------------------ Thêm  -->
    <button class="button" id="CtOpenFormAdd" type="button">Thêm tiêu chí</button>
    <div id="CtMyModalAdd" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Thêm tiêu chí</h2>
            <form style="width: 100%; display: inline-block;" action="?page=list_detail_criteria" method="POST">
                <input type="hidden" name="standardID" value="<?php echo $get_standard_ID; ?>">
                <label>
                    <span>Tên tiêu chí</span>
                    <input type="text" name="criteriaName" placeholder="...">
                </label>
                <label>
                    <span>Điểm tiêu chí</span>
                    <select class="select" name="criteriaPoint">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </label>
                <button class="mb-0 button" name="criteriaAdd" type="submit">Thêm</button>
            </form>
        </div>
    </div>
    <a class="button" href="?page=list_detail_standard">Danh sách tiêu chuẩn</a>
    <?php
        }
    ?>

    <!-- ------------------ Danh sách tiêu chuẩn  -->
    <table>
        <thead>
            <tr>
                <?php 
                    $standard_sql = "SELECT * FROM standards WHERE standard_id = '$get_standard_ID'";
                    $standard_result = mysqli_query($conn, $standard_sql);
                    if (mysqli_num_rows($standard_result) > 0) {
                        $standard_row = mysqli_fetch_assoc($standard_result);
                        ?>
                <th style="text-align: justify;">Tiêu chuẩn: <?php echo $standard_row["standard_name"] ?></th>
                <th>Điểm: <?php echo $standard_row["points"] ?></th>
                <th></th>
                <th></th>
                <?php
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
        // Truy vấn danh sách tiêu chuẩn
        $criteria_sql = "SELECT * FROM criteria WHERE standard_id = '$get_standard_ID'";
        $criteria_result = mysqli_query($conn, $criteria_sql);
        if (mysqli_num_rows($criteria_result) > 0) {
            $i = 0;
            while ($criteria_row = mysqli_fetch_assoc($criteria_result)) {
                $i++;
                ?>

            <tr class="row-d">
                <td style="text-align: justify;">
                    <a
                        href=""><?php echo '<span style="font-weight: 600;">Tiêu chí ' . $i . '</span>' . ". " . $criteria_row['criteria_name']; ?></a>
                </td>
                <td><?php echo $criteria_row['points']; ?></td>
                <td>
                    <input type="hidden" class="ctPresentID" value="<?php echo $criteria_row['criteria_id']; ?>">
                    <input type="hidden" class="sdPresentID" value="<?php echo $criteria_row['standard_id']; ?>">
                    <input type="hidden" class="ctPresentName" value="<?php echo $criteria_row['criteria_name']; ?>">
                    <input type="hidden" class="ctPresentPoint" value="<?php echo $criteria_row['points']; ?>">
                    <button class="button-disable button CtOpenFormUpdate" type="button">Sửa</button>
                </td>
                <td>
                    <form method="post" action="?page=list_detail_criteria">
                        <input type="hidden" name="ctID" value="<?php echo $criteria_row['criteria_id']; ?>">
                        <input type="hidden" name="sdID" value="<?php echo $get_standard_ID; ?>">
                        <button class="button-disable button-del button" name="criteriaDelete"
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

    <div id="ctMyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Cập nhật tiêu chuẩn</h2>
            <form style="width: 100%; display: inline-block;" action="?page=list_detail_criteria" method="POST">
                <input type="hidden" id="ctOldID" name="criteriaOldID">
                <input type="hidden" id="sdOldID" name="standardOldID">
                <label>
                    <span>Tên tiêu chuẩn</span>
                    <input type="text" id="ctFormName" name="criteriaNewName">
                </label>
                <label>
                    <span>Điểm tiêu chuẩn</span>
                    <select class="select" id="ctFormPoint" name="criteriaNewPoint">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </label>
                <button class="mb-0 button" name="criteriaUpdate" type="submit">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

<?php 
    // ------------------ Thêm 
    if (isset($_POST['criteriaAdd'])) {
        $standardID = $_POST['standardID'];
        $criteriaName = trim($_POST['criteriaName']);
        $criteriaPoint = $_POST['criteriaPoint'];
        if(empty($criteriaName)) {
            echo "<script>
                    alert('Không được để trống.');
                    window.location = '?page=list_detail_criteria&standard_ID=$standardID';
                </script>";
        }
        else {
            $check_add = "SELECT * FROM criteria WHERE criteria_name = '$criteriaName'";
            if($conn->query($check_add)->num_rows > 0) {
                echo "<script>
                        alert('Đã có tiêu chí $criteriaName.');
                        window.location = '?page=list_detail_criteria&standard_ID=$standardID';
                    </script>";
        }
            else {
                $sql = "INSERT INTO criteria (standard_id, criteria_name, points) values ('$standardID', '$criteriaName', '$criteriaPoint')";
                $re_insert_evaluation = $conn->query($sql);
                echo "<script>
                        alert('Thêm thành công.');
                        window.location = '?page=list_detail_criteria&standard_ID=$standardID';
                    </script>";
            }
        }
    }

    // ------------------ Cập nhật
    if (isset($_POST['criteriaUpdate'])) {
        $criteriaOldID = $_POST['criteriaOldID'];
        $standardOldID = $_POST['standardOldID'];
        $criteriaNewName = trim($_POST['criteriaNewName']);
        $criteriaNewPoint = $_POST['criteriaNewPoint'];
        $check_update = "SELECT * FROM criteria WHERE criteria_name = '$criteriaNewName' AND standard_id = '$standardOldID' AND criteria_id != '$criteriaOldID'";
        if($conn->query($check_update)->num_rows > 0) {
            echo "<script>
                    alert('Đã có tiêu chí $criteriaNewName.');
                    window.location = '?page=list_detail_criteria&standard_ID=$standardOldID';
                </script>";
        }
        else {
            $sql = "UPDATE criteria SET criteria_name = '$criteriaNewName', points = '$criteriaNewPoint' WHERE criteria_id = '$criteriaOldID'";
            $conn->query($sql);
            echo "<script>
                    alert('Cập nhật thành công.');
                    window.location = '?page=list_detail_criteria&standard_ID=$standardOldID';
                </script>";
        }
    }
    
    // ------------------ Xóa 
    if (isset($_POST['criteriaDelete'])) {
        $standardID = $_POST['sdID'];
        $criteriaID = $_POST['ctID'];
        $sql_criteria = "DELETE FROM criteria WHERE criteria_id = '$criteriaID'";
        $conn->query($sql_criteria);
        echo "<script>
                alert('Xóa thành công.');
                window.location = '?page=list_detail_criteria&standard_ID=$standardID';
            </script>";
}
?>
<script src="app/js/criteria/add.js"></script>
<script src="app/js/criteria/update.js"></script>