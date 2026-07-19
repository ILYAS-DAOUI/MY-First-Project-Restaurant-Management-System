<?php
include "db.php";
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $type = "user";
   $adress = $_POST['adress'];
   $phone = $_POST['phone'];
   
   $sql = "insert into usere(name, email, password, type, adress, phone) values('$name','$email','$password','$type','$adress','$phone')";

   $result = mysqli_query($conn, $sql);
   if(!$result){
     echo "Error !: " . mysqli_error($conn);
   }
   else{
      echo "<h1 style='margin-top:5px; margin-left:350px; color:green;'>Regestred is successfully</h1>"; 
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>restaurant</title>
    <style type="text/css">
         .form input{
            display: block;
            padding: 10px;
            margin:7px;
            width:90%;
            
         }
         h1{
          text-align:center;
         }
         .form{
            position: fixed;
            top:6%;
            left:33%;
            padding:30px;
            background-color:white;
            width:400px;
         }
         body{
            background-color:rgba(209, 202, 202, 0.85);
         }
         .logingbutton{
            background-color:blue;
            color: white;
            width:100%;
          
         }
         .textarea{
            width: 90%;
            height: 40%;
         }
    </style>
</head>
<body>
    <form action="regester.php"class="form" method="post">
     <h1>welcome </h1>
        Enter your name: <input type="text" name="name">
        Enter your Email: <input type="email" name="email">
        Enter your Password: <input type="password" name="password">
        Enter your adress:<br> <textarea class="textarea" name="adress"></textarea><br>
        Enter your phone number : <input type="text" name="phone" required>
        <input class="logingbutton" type="submit" name="submit" value="sign up">
        <P>Go for Loging: <a href="loging.php">Loging </a></p> 


    </form>
</body>
</html>