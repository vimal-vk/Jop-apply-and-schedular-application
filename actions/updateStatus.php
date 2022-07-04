<?php
  include '../database/connection.php';
  if (!isset($_COOKIE['user'])) {
    header("Location: ../login.php");
  }
  $response=$_GET;
  $id=$response["id"];
  $res=$response["res"];
  $redirect=$response["redirect"];
  $postres=explode("T",$_POST["scheduleTime"]);
  $postres=$postres[0]." ".$postres[1];
  $query = "update apply set schedule='$postres' where id='$id'";
  mysqli_query($connect,$query);
  header("Location: ../applied.php?id=".$redirect);
?>