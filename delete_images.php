<?php
session_start();
require_once "pdo.php";
require_once "funcs.php";
$image_id = $_GET["image_id"];
$user_id = $_SESSION["user_id"];
  $stmt = $pdo->prepare("DELETE FROM images WHERE image_id = '$image_id' AND user_id = '$user_id'");
  $stmt->execute();

  redirect("index.php");
  return;
 ?>
