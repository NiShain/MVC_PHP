<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Sinh Viên</title>
    <style>
        /* (Bạn có thể dùng chung CSS với file AddStudent) */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        /* Style cho trường readonly */
        input[readonly] {
            background-color: #eee;
            cursor: not-allowed;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Cập Nhật Thông Tin Sinh Viên</h1>
    
    <form action="../Controller/C_Student.php?mod2" method="post">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($studentDetail->id); ?>">
        
        <div>
            <label for="id_display">Id:</label>
            <input 
                type="text" 
                id="id_display" 
                value="<?php echo htmlspecialchars($studentDetail->id); ?>" 
                readonly>
        </div>
        
        <div>
            <label for="name">Họ và Tên:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="<?php echo htmlspecialchars($studentDetail->name); ?>" 
                required>
        </div>
        
        <div>
            <label for="age">Tuổi:</label>
            <input 
                type="number" 
                id="age" 
                name="age" 
                value="<?php echo htmlspecialchars($studentDetail->age); ?>" 
                required>
        </div>
        
        <div>
            <label for="university">Trường Đại Học:</label>
            <input 
                type="text" 
                id="university" 
                name="university" 
                value="<?php echo htmlspecialchars($studentDetail->university); ?>">
        </div>
        
        <div>
            <button type="submit">Lưu Cập Nhật</button>
        </div>
        
    </form>

</body>
</html>