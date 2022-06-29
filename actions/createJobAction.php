<?php
  if (!isset($_COOKIE['user'])) {
    header("Location: http://localhost/jobApp/login.php");
  }
  $response=$_POST;
  $company=$response["company"];
  $regStart=explode("T",$response["regStart"]);
  $regStart=$regStart[0]." ".$regStart[1].":00";
  $regEnd=explode("T",$response["regEnd"]);
  $regEnd=$regEnd[0]." ".$regEnd[1].":00";
  $qualification=$response["qualification"];
  $experience=$response["experience"];
  $role=$response["role"];
  $salary=$response["salary"];
  $creator=explode(" ",$_COOKIE['user'])[0];
   $connect = mysqli_connect("localhost:3306","root","","jobs");
   $query="Insert into job(creator_id,company_name,reg_start_date,reg_end_date,experience,role,qualification,salary) values ('$creator','$company','$regStart','$regEnd','$experience','$role','$qualification','$salary');";
  $res = mysqli_query($connect,$query);
  if(!$res){
    header("Location: http://localhost/jobApp/createJob.php");
    echo mysqli_error($connect);
  }
  else{
    header("Location: http://localhost/jobApp/yourjobs.php");
  }

?>