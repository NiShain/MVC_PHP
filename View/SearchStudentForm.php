<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm Kiếm Sinh Viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .search-form { 
            max-width: 600px; margin: 0 auto; padding: 20px; 
            border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;
        }
        .search-form div { margin-bottom: 10px; }
        .search-form label { margin-right: 15px; }
        .search-form input[type="text"] { width: 300px; padding: 5px; }
        .search-form button { padding: 5px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Tìm Kiếm Sinh Viên</h1>
    <p style="text-align: center;"><a href="../index.html">Quay về trang chủ</a></p>

    <form class="search-form" action="C_Student.php" method="get">
        <input type="hidden" name="mod4" value="true">
        
        <div>
            <strong>Tìm kiếm theo:</strong>
            <label>
                <input type="radio" name="type" value="id" checked> ID
            </label>
            <label>
                <input type="radio" name="type" value="name"> Tên SV
            </label>
            <label>
                <input type="radio" name="type" value="university"> Trường
            </label>
        </div>
        
        <div>
            <label for="keyword">Nhập từ khóa:</label>
            <input type="text" id="keyword" name="keyword" required>
        </div>
        
        <div>
            <button type="submit">Tìm Kiếm</button>
        </div>
    </form>

    <?php
        if (!empty($studentList)) {
            echo "<h2>Kết quả tìm kiếm:</h2>";
            echo "<table>";
            echo "<thead><tr><th>Mã SV</th><th>Họ Tên</th><th>Tuổi</th><th>Trường</th></tr></thead>";
            echo "<tbody>";
            foreach ($studentList as $student) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($student->id) . "</td>";
                echo "<td>" . htmlspecialchars($student->name) . "</td>";
                echo "<td>" . htmlspecialchars($student->age) . "</td>";
                echo "<td>" . htmlspecialchars($student->university) . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } 
        else if (isset($_GET['keyword'])) {
            echo "<h3 style='text-align: center; color: red;'>Không tìm thấy sinh viên nào.</h3>";
        }
    ?>

</body>
</html>