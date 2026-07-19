<?php
session_start(); 

include "db.php";

$sql = "SELECT * FROM menu_tems";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Home - Order Now</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 8%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ff4757;
            text-decoration: none;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            align-items: center;
        }
        .navbar ul li {
            margin-left: 25px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #555;
            font-weight: 600;
            transition: 0.3s;
            font-size: 16px;
        }
        .navbar ul li a:hover {
            color: #ff4757;
        }
        
        .navbar ul li a.login-btn {
            background-color: #ff4757;
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
        }
        .navbar ul li a.login-btn:hover {
            background-color: #e84118;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 6px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-btn:hover {
            background-color: #bd2130;
        }

        header {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            margin-bottom: 40px;
        }
        header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }
        header hr {
            width: 80px;
            height: 4px;
            background-color: #ff4757;
            border: none;
            margin: 10px auto 0 auto;
            border-radius: 2px;
        }

        .product_container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 50px 20px;
        }
        .product_card {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: 0.3s transform, 0.3s box-shadow;
            display: flex;
            flex-direction: column;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .card .img-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background-color: #eee;
        }
        .card .img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s ease;
        }
        .card:hover .img {
            transform: scale(1.08);
        }

        .card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .card h3 {
            font-size: 20px;
            color: #2f3542;
            margin-bottom: 8px;
        }
        .card .category {
            font-size: 12px;
            text-transform: uppercase;
            background-color: #f1f2f6;
            color: #747d8c;
            padding: 3px 8px;
            border-radius: 4px;
            align-self: flex-start;
            margin-bottom: 12px;
            font-weight: bold;
        }
        .card p {
            font-size: 14px;
            color: #747d8c;
            line-height: 1.5;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #f1f2f6;
        }
        .card .price {
            font-size: 22px;
            font-weight: bold;
            color: #2ed573;
        }
        .card .order-btn {
            background-color: #ff4757;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
            text-decoration: none;
            text-align: center;
        }
        .card .order-btn:hover {
            background-color: #e84118;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo">🍔 MyRestaurant</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <li style="font-weight: bold; color: #2ed573;">👋 Welcome Back!</li>
                <li><a href="logout.php" class="logout-btn">Log Out</a></li>
            <?php else: ?>
                <li><a href="loging.php" class="login-btn">Login</a></li>
                <li><a href="regester.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header>
        <h1>Order Your Favorite Item</h1>
        <hr>
    </header>

    <section class="product_container">
        <div class="product_card">
            <?php 
            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {  
            ?>
                <div class="card">
                    <div class="img-container">
                        <img class="img" src="image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>
                    
                    <div class="card-content">
                        <span class="category"><?php echo $row['catagory']; ?></span>
                        
                        <h3><?php echo $row['name']; ?></h3>
                        <p>Freshly prepared with high-quality ingredients. Order now and enjoy the taste of our special <?php echo $row['name']; ?>.</p>
                        
                        <div class="card-footer">
                            <span class="price">$<?php echo number_format($row['price'], 2); ?></span>
                            
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <a href="place_order.php?item_id=<?php echo $row['id']; ?>" class="order-btn">Order Now</a>
                            <?php else: ?>
                                <a href="loging.php" class="order-btn" onclick="alert('Please login first to order your food!');">Order Now</a>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            <?php   
                }
            } else {
                for($i = 1; $i <= 3; $i++) {
            ?>
                <div class="card">
                    <div class="img-container">
                        <img class="img" src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=500&q=80" alt="Delicious Food">
                    </div>
                    <div class="card-content">
                        <span class="category">Pizza</span>
                        <h3>Sample Item <?php echo $i; ?></h3>
                        <p style="color: red;">Your database is currently empty. Add items from Admin Panel to see them here!</p>
                        <div class="card-footer">
                            <span class="price">$12.99</span>
                            <a href="loging.php" class="order-btn">Order Now</a>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } 
            ?>
        </div>
    </section>

</body>
</html>