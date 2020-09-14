<?php
require_once "pdo.php"; // Database Connection..
require_once "funcs.php";
session_start();

// check if logged in..
if(!isset($_SESSION["username"])){
    die("ACCESS DENIED");
}elseif (isset($_POST["cancel"])) {
  redirect("index.php");
  return;
}elseif (isset($_POST["delete"])) {
  $user_id = $_SESSION["user_id"];
  $stmt = $pdo->query("DELETE FROM users WHERE user_id = '$user_id'");

  session_destroy();
  redirect("login.php");
}
// Remove the information belong to user with the mentioned user_id

 ?>

 <html >
   <head>
     <meta charset="utf-8">
     <title></title>
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link rel="stylesheet" type="text/css" href="css/styles.css">
   </head>
   <body class="delete_pages">
     <div class="container">
	<div class="row">

	    <div class="col-md-8 col-md-offset-2">

    		<h2>Delete <?=$_SESSION["username"]?>?</h2>

    		<form method="POST">
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary" name="delete">
    		            Delete
    		        </button>
    		        <button class="btn btn-default" name="cancel">
    		            Cancel
    		        </button>
    		    </div>
    		</form>
		</div>
	</div>
</div>
   </body>
 </html>
