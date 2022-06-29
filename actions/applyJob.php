<?php
  if (!isset($_COOKIE['user'])) {
    header("Location: http://localhost/jobApp/login.php");
  }
  $user=$_COOKIE['user'][0];
  $response=$_GET['id'];
  echo $response;
  $connect = mysqli_connect("localhost:3306","root","","jobs");
  $query = "insert into apply(applier_id,job_id,status) values ($user,$response,'Applied')";
  $res = mysqli_query($connect,$query);
  header("Location: http://localhost/jobApp/particularJob.php?id=".$response);
?>