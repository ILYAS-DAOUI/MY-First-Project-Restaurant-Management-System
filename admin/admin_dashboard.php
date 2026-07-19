<?php
include("../db.php"); // بدل الاسم إذا كان مختلف

$totalUsers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM usere"));
$totalMenu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM menu_tems"));
$totalOrders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
$pending = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE Status='pending'"));
$delivered = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE Status='delivered'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
     .dashboard-cards{
        display:flex;
        gap:20px;
        flex-wrap:wrap;
        margin-top:20px;
    }

    .card{
        background:#fff;
        padding:25px;
        border-radius:12px;
        box-shadow:0 5px 15px rgba(0,0,0,.1);
        width:220px;
        transition:.3s;
    }

    .card:hover{
        transform:translateY(-5px);
    }

    .card h3{
        margin:0;
        color:#666;
        font-size:18px;
    }

    .card h1{
        margin-top:15px;
        font-size:38px;
        color:#007bff;
    }

    table{
        width:100%;
        margin-top:20px;
        border-collapse:collapse;
        background:#fff;
        box-shadow:0 5px 15px rgba(0,0,0,.1);
    }

    table th{
        background:#007bff;
        color:white;
        padding:15px;
    }

    table td{
        padding:15px;
        border-bottom:1px solid #ddd;
    }

    .pending{
        background:#ffc107;
        padding:6px 12px;
        border-radius:20px;
        color:#000;
        font-weight:bold;
    }

    .delivered{
        background:#28a745;
        padding:6px 12px;
        border-radius:20px;
        color:#fff;
        font-weight:bold;
    }
    </style>
</head>
<body>

   
<h2>Dashboard Overview</h2>

<div class="dashboard-cards">

    <div class="card">
        <h3>👥 Users</h3>
        <h1><?php echo $totalUsers; ?></h1>
    </div>

    <div class="card">
        <h3>🍔 Menu Items</h3>
        <h1><?php echo $totalMenu; ?></h1>
    </div>

    <div class="card">
        <h3>📦 Orders</h3>
        <h1><?php echo $totalOrders; ?></h1>
    </div>

    <div class="card">
        <h3>⏳ Pending</h3>
        <h1><?php echo $pending; ?></h1>
    </div>

    <div class="card">
        <h3>✅ Delivered</h3>
        <h1><?php echo $delivered; ?></h1>
    </div>

</div>

<h2 style="margin-top:40px;">Recent Orders</h2>

<table>

<tr>
<th>Customer</th>
<th>Item</th>
<th>Status</th>
</tr>

<?php

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC LIMIT 5");

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['item_name']; ?></td>

<td>

<?php

if($row['Status']=="pending")
{
echo "<span class='pending'>Pending</span>";
}
else
{
echo "<span class='delivered'>Delivered</span>";
}

?>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>