<?php
  if (!isset($_COOKIE['user'])) {
    header("Location: http://localhost/jobApp/login.php");
  }
  $response=$_GET;
  $id=$response["id"];
  $res=$response["res"];
  $redirect=$response["redirect"];
  $postres=explode("T",$_POST["scheduleTime"]);
  $postres=$postres[0]." ".$postres[1];
  $connect = mysqli_connect("localhost:3306","root","","jobs");
  $query = "update apply set schedule='$postres' where id='$id'";
  mysqli_query($connect,$query);
  header("Location: http://localhost/jobApp/applied.php?id=".$redirect);
?>