<?php
require_once "funcs.php";
session_start();
session_destroy();
redirect("login.php");
 ?>
