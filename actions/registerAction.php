<?php
  include '../database/connection.php';

  $response = $_POST;
  $email = $response["email"];
  $password = $response["password"];
  $name = $response["name"];
  $phone = $response["phone"];
  $role = $response["role"];
  $additionalField1 = $response["additionalField1"];
  $additionalField2 = $response["additionalField2"];

  $query="Insert into people(email,password,name,phone,role,additionalField1,additionalField2) values ('$email','$password','$name',$phone,'$role','$additionalField1','$additionalField2');";
  $res = mysqli_query($connect,$query);
  if($res){
    header("Location: ../login.php");
    echo mysqli_error($connect);
  }
  else{
    header("Location: ../register.php");
  }

?>