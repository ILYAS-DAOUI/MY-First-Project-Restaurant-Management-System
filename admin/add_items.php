<?php
session_start();
include "../db.php";

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin") {
    
    if(isset($_POST['submit'])){
        $image = $_FILES['image']['name'];
        $temp_location = $_FILES['image']['tmp_name'];
        
        $tar_location = "../image/" . $image; 
        
        $name = $_POST['name'];
        $price = $_POST['price'];
        $catagory = $_POST['catagory'];
        
        $sql = "INSERT INTO menu_tems(image, name, price, catagory) VALUES ('$image', '$name', '$price', '$catagory')";
        
        $result = mysqli_query($conn, $sql);
        
        if(!$result){
            echo "<h3 style='color:red; text-align:center;'>Error !: {$conn->error}</h3>";
        }
        else{
            // 3. تصحيح: الطريقة الصحيحة لرفع الصورة للسيرفر
            if(move_uploaded_file($temp_location, $tar_location)) {
                echo "<h3 style='color:green; text-align:center;'>Item added and image uploaded successfully!</h3>";
            } else {
                echo "<h3 style='color:orange; text-align:center;'>Item added, but failed to upload image. Check folder permissions!</h3>";
            }
        }
    }
} 
else {
    // إذا مكانش أدمن أو مامسجلش، كيطردو نيشان لصفحة الـ login
    header("Location: ../loging.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard - Add Items</title>
    <style>
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f6f9;
        }

        .header { 
            background-color: #ffffff; 
            color: #333; 
            padding: 15px 30px; 
            margin-left: 20%; 
            text-align: right; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .header a { 
            text-decoration:none; 
            color: white; 
            padding: 8px 16px; 
            background-color: #dc3545; 
            border-radius: 4px;
            font-weight: bold;
            transition: 0.3s;
        }
        .header a:hover {
            background-color: #c82333;
        }

        .sidebar { 
            background-color: #1e1e2f; 
            color: white; 
            position: fixed; 
            top: 0; 
            left: 0; 
            height: 100%; 
            width: 20%; 
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            text-align: left;
        }
        .sidebar h2 {
            text-align: center;
            font-size: 1.2rem;
            padding: 20px 0;
            margin: 0;
            background-color: #1a1a27;
            border-bottom: 1px solid #2b2b3d;
        }
        .sidebar a { 
            text-decoration: none; 
            color: #b3b3cc; 
            display: block; 
            padding: 15px 20px; 
            border-bottom: 1px solid #2b2b3d;
            transition: 0.3s;
        }
        .sidebar a:hover { 
            background-color: #007bff; 
            color: white;
            padding-left: 25px;
        }
        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }

        .main { 
            margin-left: 23%; 
            margin-top: 30px; 
            padding: 20px; 
        }
        .main h3 {
            color: #333;
            margin-bottom: 20px;
        }
        .main form { 
            background-color: #ffffff; 
            padding: 30px; 
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #495057;
        }
        .main input[type="text"],
        .main input[type="number"],
        .main input[type="email"],
        .main input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #f8f9fa;
            transition: 0.3s;
        }
        .main input:focus {
            border-color: #007bff;
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.15);
        }
        
        .submitbtn { 
            background-color: #007bff; 
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 10px;
        }
        .submitbtn:hover { 
            background-color: #0056b3; 
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="add_items.php" class="active">Add Menu Items</a>
        <a href="view_items.php">View Menu Items</a>
    </div>

    <div class="header">
        <a href="../logout.php">Log Out</a>
    </div>
    
    <div class="main">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add New Product</h3>
            
            <div class="form-group">
                <label>Upload Item Image:</label>
                <input type="file" name="image" required>
            </div>
            
            <div class="form-group">
                <label>Enter Item Name:</label>
                <input type="text" name="name" placeholder="e.g. Cheese Pizza" required>
            </div>
            
            <div class="form-group">
                <label>Enter Item Price ($):</label>
                <input type="number" name="price" step="0.01" placeholder="e.g. 12.99" required>
            </div>
            
            <div class="form-group">
                <label>Enter Item Catagory:</label>
                <input type="text" name="catagory" placeholder="e.g. Pizzas" required>
            </div>
            
          >
            
            <input class="submitbtn" type="submit" name="submit" value="Add Item">
        </form>
    </div>

</body>
</html>