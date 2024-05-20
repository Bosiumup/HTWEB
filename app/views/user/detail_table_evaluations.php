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

.button:hover {
    background-color: #45a049;
}
</style>

<div class="container">
    <h2>Bảng đánh giá tiêu chuẩn</h2>
    <form method="post" action="process_evaluation.php">
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
                    $sql = "SELECT * FROM standards";
                    $result = mysqli_query($conn, $sql);

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
                        <select name="user_ratings[]">
                            <option value="0.5">5</option>
                            <option value="1">10</option>
                        </select>
                    </td>
                    <td>
                        <!-- <span><?php echo $row['admin_rating']; ?></span> -->
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <button type="submit" class="button">Gửi đánh giá</button>
        </div>
    </form>
</div>