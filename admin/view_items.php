<?php
session_start();
include "../db.php";

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin") {
    
    $sql = "SELECT * FROM menu_tems";
    $result = mysqli_query($conn, $sql);
    
    if(!$result){
        echo "Error!: {$conn->error}";
        exit();
    }
} 
else {
    header("Location: ../loging.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - View Items</title>
    <style>
        body { 
            margin: 0; padding: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f6f9; 
        }
        .header { 
            background-color: #ffffff; color: #333; padding: 15px 30px; margin-left: 20%; text-align: right; box-shadow: 0 2px 5px rgba(0,0,0,0.05); 
        }
        .header a { 
            text-decoration:none; color: white; padding: 8px 16px; background-color: #dc3545; border-radius: 4px; font-weight: bold; transition: 0.3s; 
        }
        .header a:hover { background-color: #c82333; }

        .sidebar { 
            background-color: #1e1e2f; color: white; position: fixed; top: 0; left: 0; height: 100%; width: 20%; box-shadow: 2px 0 5px rgba(0,0,0,0.1); text-align: left; 
        }
        .sidebar h2 { text-align: center; font-size: 1.2rem; padding: 20px 0; margin: 0; background-color: #1a1a27; border-bottom: 1px solid #2b2b3d; }
        .sidebar a { text-decoration: none; color: #b3b3cc; display: block; padding: 15px 20px; border-bottom: 1px solid #2b2b3d; transition: 0.3s; }
        .sidebar a:hover { background-color: #007bff; color: white; padding-left: 25px; }
        .sidebar a.active { background-color: #007bff; color: white; }

        .main { margin-left:23%; margin-top:30px; padding: 20px; }
        .main h3 { color: #333; margin-bottom: 20px; }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f3f5;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="add_items.php">Add Menu Items</a>
        <a href="view_items.php" class="active">View Menu Items</a>
    </div>

    <div class="header">
        <a href="../logout.php">Log Out</a>
    </div>
    
    <div class="main">
        <h3>Menu Items List</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Item Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){  
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <img src="../image/<?php echo $row['image']; ?>" class="product-img" alt="food">
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['catagory']; ?></td> </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No items found in menu.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>