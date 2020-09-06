<?php
// check email function
function check_email($email, $pdo){
  $read = $pdo->query("SELECT email FROM users");
  while($row = $read->fetch(PDO::FETCH_ASSOC)){
    if($email == $row["email"]) return true;
  }

  return false;
}

// check password function
function check_pass($pass, $pdo){
  $email = $_POST["email"];
  $read = $pdo->prepare("SELECT password FROM users WHERE email = '$email'");
  $read->execute();

  while($row = $read->fetch(PDO::FETCH_ASSOC)){
    if($pass === $row["password"]) return true;
  }
  return false;
}

// redirect function
function redirect ($url){
  header("LOCATION: " . $url);
}

//Show flash messages  
function flash_msg(){
  if(isset($_SESSION["message"])){
    alert($_SESSION["message"]);
    unset($_SESSION["message"]);
  }
}

//alert function
function alert($msg){
  echo '<script type="text/javascript"> alert("'.$msg.'"); </script>';
}
 ?>
