<?php
require_once 'pdo.php';
require_once 'funcs.php';
session_start();

flash_msg();

if(isset($_POST["email"]) && isset($_POST["pass"])){

  if(empty($_POST["email"]) || empty($_POST["pass"])){

    $_SESSION["message"] = "All fields required";
    redirect("login.php");

  }elseif(!check_email($_POST["email"], $pdo)){

    $_SESSION["message"] = "Invalid email.";
    redirect("login.php");

  }elseif(!check_pass($_POST["pass"], $pdo)){

    $_SESSION["message"] = "password is wrong, please try again";
      redirect("login.php");

  }else{
    $email = $_POST["email"];
    $stmt = $pdo->prepare("SELECT user_id, username FROM users WHERE email = '$email'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION["username"] = $row["username"];
    $_SESSION["user_id"] = $row["user_id"];
    redirect("index.php");
  }
}


 ?>
<html >
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/forms.css">
     <title>برمجة موقع ويب من الألف الى الياء مع محمود مارديني</title>
   </head>
   <body>
     <div class="wrapper fadeInDown">
       <div id="formContent">
         <!-- Tabs Titles -->
         <a href="login.php"><h2 class="active"> Login </h2></a>
         <a href="signup.php"><h2 class="inactive underlineHover"> Sign Up </h2></a>

         <!-- Icon -->
         <div class="fadeIn first">
           <img src="icons/icon.png" id="icon" alt="User Icon" />
         </div>

         <!-- Login Form -->
         <form method="post">
           <input type="email" class="fadeIn second" name="email" placeholder="email">
           <input type="password"  class="fadeIn third" name="pass" placeholder="password">
           <input type="submit" class="fadeIn fourth" value="Login">
         </form>

       </div>
     </div>
   </body>
</html>
