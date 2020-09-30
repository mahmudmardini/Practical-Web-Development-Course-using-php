<?php
require_once "pdo.php";
require_once "funcs.php";
session_start();

if(!isset($_SESSION["username"])){
  redirect("login.php");
}

if(isset($_POST["logout"])){
  redirect("logout.php");
  return;
}elseif(isset($_POST["cancel"])){
  redirect("index.php");
  return;
}

flash_msg();

$user_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT username, email, password FROM users WHERE user_id = '$user_id'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $row["username"];
$email = $row["email"];
$password = $row["password"];

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["pass2"]) ){

$username = $_POST["username"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$pass2 = $_POST["pass2"];

if( empty($username) || empty($email) || empty($pass) || empty($pass2) ){
  $_SESSION["message"] = "All fields required";
  redirect("profile.php");
  return;
}elseif ( $pass !== $pass2 ) {
    $_SESSION["message"] = "Passwords don't match, please try again";
    redirect("profile.php");
    return;
}else{
  $hashed_pass = hash('md5', "Hell*_woRlD" . $pass);
  $update_stmt = $pdo->prepare("UPDATE users SET username = '$username', email = '$email', password = '$hashed_pass' WHERE user_id = '$user_id'");
  $update_stmt->execute();

  $_SESSION["username"] = $username;
  $_SESSION["message"] = "Your information updateded successfully";
  redirect("index.php");
  return;
}
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title></title>
  </head>
  <body>
    <div class="container">
	     <div class="row">
	        <div class="col-md-8 col-md-offset-2">
    		      <h1>Profile</h1>
    		      <form  method="POST">
    		          <div class="form-group">
    		             <label for="title">User Name <span class="require">*</span></label>
    		             <input type="text" class="form-control" name="username" value="<?=$username?>" />
    		          </div>
                  <div class="form-group">
                      <label for="email">Email <span class="require">*</span></label>
                      <input type="email" class="form-control" name="email" value="<?=$email?>" />
                  </div>
                  <div class="form-group">
                    <label for="title">Password <span class="require">*</span></label>
                    <input type="password" class="form-control" name="pass" value="<?=$password?>">
                  </div>
                  <div class="form-group">
                    <label for="title">Confirm Password <span class="require">*</span></label>
                    <input type="password" class="form-control" name="pass2">
                  </div>
    		          <div class="form-group">
    		              <button type="submit" class="btn btn-primary">
    		                  Save
    		              </button>
                      <button class="btn btn-primary" name="logout">
                          Logout
                      </button>
    		              <button class="btn btn-default" name="cancel">
    		                  Cancel
    		              </button>
    		           </div>
              </form>
              <a href="delete_accounts.php">Delete my account</a>
		       </div>
	        </div>
        </div>
  </body>
</html>
