<?php
require_once "pdo.php";
require_once "funcs.php";
session_start();

if(!isset($_SESSION["username"])){
  redirect("login.php");
  return;
}else if(isset($_POST["cancel"])){
    redirect("index.php");
    return;
  }

flash_msg();

  $user_id = $_SESSION["user_id"];

  if(isset($_POST["title"]) && isset($_FILES["image"])){
    if(empty($_POST["title"]) || empty($_FILES["image"])){
      $_SESSION["message"] = "All fields required";
      redirect("add.php");
      return;
    }else {
      $title = $_POST["title"];
      $image = $_FILES["image"]["name"];
      $target = "images/" . $image;
      $tmp_name = $_FILES["image"]["tmp_name"];

      $insert_stmt = $pdo->prepare("INSERT INTO images (user_id, title, image) VALUES ('$user_id', '$title', '$image')");

      if(move_uploaded_file($tmp_name, $target)){
        $insert_stmt->execute();

        $_SESSION["message"] = "image uploaded successfully";
        redirect("index.php");
        return;
      }else {
        $_SESSION["message"] = "failed..";
        redirect("add.php");
        return;
      }
    }
  }
 ?>

<html>
 <head>
   <meta charset="utf-8">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <title>Add a new image</title>
 </head>
  <body>
   <div class="container">
	    <div class="row">
	       <div class="col-md-8 col-md-offset-2">
           <h1>Add a new image</h1>
           <form method="post" enctype="multipart/form-data">
             <div class="form-group">
               <label for="title">Title </label>
               <input type="text" class="form-control" name="title" />
             </div>
             <div class="form-group">
               <label for="title">Image </label>
               <input type="file" class="form-control" name="image" accept=".jpg,.png, .jpeg, .gif, .bmp, .webp"/>
             </div>
             <div class="form-group">
               <button type="submit" class="btn btn-primary">
                 Add
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
