<?php

  $response = $_POST;
  $email = $response["email"];
  $password = $response["password"];
  $connect = mysqli_connect("localhost:3306","root","","jobs");
  $query="select * from people where email='".$email."' and password='".$password."';";
  $res = mysqli_query($connect,$query);
  if(!$res){
    echo mysqli_error($connect);
  }
  if($row = $res->fetch_assoc()) {
    $value=$row['id']." ".$row['role'];
    setcookie("user",$value,time() + (86400 * 30), "/");
    header("Location: http://localhost/jobApp/profile.php");
  }
  else{
    header("Location: http://localhost/jobApp/login.php");
  }

?>