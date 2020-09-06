<?php
  $pdo = new PDO('mysql:host=localhost;port=#port_number;dbname=web_dev;charset=utf8', '#username', '#password');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
