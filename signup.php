<?php
require_once "pdo.php";
require_once "funcs.php";
session_start();

flash_msg();

if( isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["pass2"]) ){

$username = $_POST["username"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$pass2 = $_POST["pass2"];

if( empty($username) || empty($email) || empty($pass) || empty($pass2) ){

  $_SESSION["message"] = "All fields required";
  redirect("signup.php");
  return;

}elseif ( check_email($email, $pdo) ) {

    $_SESSION["message"] = "this account is already exists. Please sign in or try again with another email";
    redirect("signup.php");
    return;

}elseif ( $pass !== $pass2 ) {

    $_SESSION["message"] = "Passwords don't match, please try again";
    redirect("signup.php");
    return;

}else{

  $hashed_pass = hash('md5', "Hell*_woRlD" . $pass);
  $insert_stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_pass')");
  $insert_stmt->execute();

  $_SESSION["message"] = "Your account added successfully";
  redirect("login.php");
  return;
}
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/forms.css">
    <title>Sign Up</title>
  </head>
  <body>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->
        <a href="login.php"><h2 class="inactive underlineHover"> Login </h2></a>
        <a href="signup.php"><h2 class="active"> Sign Up </h2></a>

        <!-- Icon -->
        <div class="fadeIn first">
          <img src="icons/icon.png" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form method="post">
          <input type="text" class="fadeIn second" name="username" placeholder="username">
          <input type="email" class="fadeIn second" name="email" placeholder="email">
          <input type="password"  class="fadeIn third" name="pass" placeholder="password">
          <input type="password"  class="fadeIn third" name="pass2" placeholder="confirm password">
          <input type="submit" class="fadeIn fourth" value="Sign Up">
        </form>
      </div>
    </div>
  </body>
</html>
