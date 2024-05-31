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
    <button class="button" id="SdOpenFormAdd" type="button">Thêm tiêu chuẩn</button>
    <div id="SdMyModalAdd" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Thêm tiêu chuẩn</h2>
            <form style="width: 100%; display: inline-block;" action="?page=list_detail_evaluation" method="POST">
                <label>
                    <span>Tên tiêu chuẩn</span>
                    <input type="text" name="standardName" placeholder="...">
                </label>
                <label>
                    <span>Điểm tiêu chuẩn</span>
                    <input class="readonly" type="text" name="standardPoint" value="10" readonly>
                </label>
                <button class="mb-0 button" name="standardAdd" type="submit">Thêm</button>
            </form>
        </div>
    </div>
    <form class="form-css" method="post" action="?page=list_detail_evaluation">
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">Tên tiêu chuẩn</th>
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

                <tr>
                    <td style="text-align: left;">
                        <a
                            href=""><?php echo '<span style="font-weight: 600;">Tiêu chuẩn ' . $i . '</span>' . ". " . $standard_row['standard_name']; ?></a>
                    </td>
                    <td><?php echo $standard_row['points']; ?></td>
                    <td><button class="button-disable button" id="SdOpenFormUpdate" type="button">Sửa</button></td>
                    <td><button class="button-disable button-del button" name="" type="submit">Xóa</button></td>
                </tr>

                <?php
            }
        }
        ?>
            </tbody>
        </table>
    </form>
</div>

<?php 
    if (isset($_POST['standardAdd'])) {
        // $evaluation_id = (int) sprintf('%u', hexdec(substr(uniqid(), 8, 13)));
        $standardName = $_POST['standardName'];
        $standardPoint = $_POST['standardPoint'];
        $sql = "INSERT INTO standards (standard_name, points) values ('$standardName', '$standardPoint')";
        $re_insert_evaluation = $conn->query($sql);
        echo "<script>
                alert('Thêm thành công');
                window.location = '?page=list_detail_evaluation';
            </script>";
    }
?>
<script src="app/js/add.js"></script>