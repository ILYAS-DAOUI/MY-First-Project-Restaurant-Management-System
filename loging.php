<?php
session_start(); 
include "db.php";

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM usere WHERE email ='$email'";
   $result = mysqli_query($conn, $sql);
   
   if(!$result){
      echo "Error!: {$conn->error}";
   }
   else{
      if($result->num_rows > 0){
         $row = mysqli_fetch_assoc($result);
         
         if($row['password'] == $password){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['type'];
            
            if($_SESSION['user_type'] == "admin"){
               header("Location: admin/admin_dashboard.php");
               exit();
            }
            elseif($_SESSION['user_type'] == "user"){
               header("Location: index.php");
               exit();
            }
         }
         else{
            echo "<h3 style='position:fixed; left:40%; top:20%; color:red; z-index:1000;'>password is wrong!</h3>";
         }
      }
      else{
         echo "<h3 style='position:fixed; left:40%; top:20%; color:red; z-index:1000;'>Email not found!</h3>";
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant - Login</title>
    <style type="text/css">
         * { box-sizing: border-box; }
         body { 
             background-color: #f4f6f9; 
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 100vh;
             margin: 0;
         }
         .form { 
             background-color: white; 
             padding: 30px; 
             border-radius: 8px; 
             box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
             width: 350px; 
         }
         .form input[type="email"], .form input[type="password"] { 
             display: block; 
             padding: 10px; 
             margin: 10px 0 20px 0; 
             width: 100%; 
             border: 1px solid #ccc;
             border-radius: 4px;
         }
         .logingbutton { 
             background-color: #007bff; 
             color: white; 
             width: 100%; 
             padding: 12px;
             border: none;
             border-radius: 4px;
             font-weight: bold;
             cursor: pointer; 
             transition: 0.2s;
         }
         .logingbutton:hover {
             background-color: #0056b3;
         }
         .form p {
             text-align: center;
             margin-top: 15px;
             font-size: 14px;
             color: #555;
         }
         .form a {
             color: #007bff;
             text-decoration: none;
         }
    </style>
</head>
<body>
    <form action="" class="form" method="post">
        <h2 style="text-align: center; margin-bottom: 20px; color: #333;">Sign In</h2>
        <label>Enter your Email:</label>
        <input type="email" name="email" required>
        
        <label>Enter your Password:</label>
        <input type="password" name="password" required>
        
        <input class="logingbutton" type="submit" name="submit" value="Log in">
        <p>Don't have an account? <a href="regester.php">Register</a></p> 
    </form>
</body>
</html>