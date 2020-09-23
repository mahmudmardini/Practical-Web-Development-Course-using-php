<?php
require_once "pdo.php";
require_once "funcs.php";
$image_id = $_GET["image_id"];

  $stmt = $pdo->prepare("DELETE FROM images WHERE image_id = '$image_id'");
  $stmt->execute();

  redirect("index.php");
  return;
 ?>
