<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: loging.php");
    exit();
}

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    
    $sql = "SELECT * FROM menu_tems WHERE id = $item_id";
    $result = mysqli_query($conn, $sql);
    $item = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Order</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            background-color: #f4f6f9; 
            text-align: center; 
            padding: 50px; 
            margin: 0;
        }
        .order-box { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            display: inline-block; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
            max-width: 450px;
            width: 100%;
        }
        h2 { color: #2ed573; margin-bottom: 20px; }
        p { color: #555; font-size: 16px; line-height: 1.6; }
        .item-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ff4757;
            text-align: left;
        }
        .btn { 
            display: inline-block; 
            padding: 12px 24px; 
            background-color: #2ed573; 
            color: white; 
            text-decoration: none; 
            border-radius: 6px; 
            font-weight: bold; 
            transition: 0.2s;
        }
        .btn:hover { background-color: #26af5f; }
    </style>
</head>
<body>

    <div class="order-box">
        <h2>🎉 Order In Progress!</h2>
        <p>Your session is active. You are logged in successfully.</p>
        
        <?php if (isset($item)): ?>
            <div class="item-details">
                <p><strong>Item Name:</strong> <?php echo $item['name']; ?></p>
                <p><strong>Price:</strong> $<?php echo number_format($item['price'], 2); ?></p>
                <p><strong>Category:</strong> <?php echo $item['catagory']; ?></p>
            </div>
        <?php endif; ?>
        
        <a href="index.php" class="btn">Confirm & Go Home</a>
    </div>

</body>
</html>