<?php
  include '../database/connection.php';
  if (!isset($_COOKIE['user'])) {
    header("Location: ../login.php");
  }
  $user=$_COOKIE['user'][0];
  $response=$_GET['id'];
  echo $response;
  $query = "insert into apply(applier_id,job_id,status) values ($user,$response,'Applied')";
  $res = mysqli_query($connect,$query);
  header("Location: ../particularJob.php?id=".$response);
?>