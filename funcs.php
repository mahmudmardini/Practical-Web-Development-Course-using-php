<?php

function check_email($email, $pdo){
  $read = $pdo->query("SELECT email FROM users");
  while($row = $read->fetch(PDO::FETCH_ASSOC)){
    if($email == $row["email"]) return true;
  }
  return false;
}

function check_pass($pass, $pdo){

  $email = $_POST["email"];
  $hashed_pass = hash('md5', "Hell*_woRlD" . $pass);
  $read = $pdo->prepare("SELECT password FROM users WHERE email = '$email'");
  $read->execute();

  while($row = $read->fetch(PDO::FETCH_ASSOC)){
    if($hashed_pass === $row["password"]) return true;
      }
  return false;
}

function redirect ($url){
  header("LOCATION: " . $url);
}

function alert($msg){
  echo '<script type="text/javascript"> alert("'.$msg.'"); </script>';
}

function flash_msg(){
  if(isset($_SESSION["message"])){
    alert($_SESSION["message"]);
    unset($_SESSION["message"]);
  }
}
 ?>
