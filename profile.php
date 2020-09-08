<?php
require_once "pdo.php";
require_once "funcs.php";
session_start();

if(!isset($_SESSION["username"])){
  redirect("login.php");
}


flash_msg();


 ?>

<html >
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
    		        <input type="text" class="form-control" name="" value="" />
    		    </div>

            <div class="form-group">
               <label for="email">Email <span class="require">*</span></label>
               <input type="email" class="form-control" name="" value="" />
           </div>

       <div class="form-group">
          <label for="title">Password <span class="require">*</span></label>
          <input type="password" class="form-control" name="" value="">
      </div>

      <div class="form-group">
         <label for="title">Confirm Password <span class="require">*</span></label>
         <input type="password" class="form-control" name="">
     </div>

    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Save
    		        </button>
                <button class="btn btn-primary" name="">
                   Logout
               </button>
    		        <button class="btn btn-default" name="">
    		            Cancel
    		        </button>
    		    </div>

    		</form>
        <a href="">Delete my account</a>
		</div>

	</div>
</div>
  </body>
</html>
