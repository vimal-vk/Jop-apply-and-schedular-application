<?php
  include '../database/connection.php';
  $response = $_POST;
  $email = $response["email"];
  $password = $response["password"];
  $query="select * from people where email='".$email."' and password='".$password."';";
  $res = mysqli_query($connect,$query);
  if(!$res){
    echo mysqli_error($connect);
  }
  if($row = $res->fetch_assoc()) {
    $value=$row['id']." ".$row['role'];
    setcookie("user",$value,time() + (86400 * 30), "/");
    header("Location: ../profile.php");
  }
  else{
    header("Location: ../login.php");
  }

?>