<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JOB APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="static/style.css" type="text/css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" style="margin-left:20px" href="#">JOB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jobs.php">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <ul class="navbar-nav" style="margin-left:500px">
      <?php
        if (!isset($_COOKIE['user'])) {
          echo '<li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>';
        }
        else{
          $role=explode(" ",$_COOKIE['user']);
          if($role[1]=="interviewer"){
            echo '<li class="nav-item">
              <a class="nav-link" href="createJob.php">Create</a>
            </li>';
          }
          echo '<li class="nav-item">
            <a class="nav-link" href="yourjobs.php">User jobs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>';
        }
      ?>
    </ul>
  </div>
  </nav>
  <div class="container margin-fix bg-light">
    <button type="button" class="btn btn-warning" onclick="javascript:history.go(-1)">< Back</button>
    <?php
      $jobId = $_GET['id'];
      $query = "select * from job where job_id='$jobId'";
      include 'database/connection.php';
      $res = mysqli_query($connect,$query);
      $data = $res->fetch_assoc();
      echo "<h1>".$data['role']."</h1>";
      echo "<h3 style='color:blue;'>from ".$data['company_name']."</h3>";
      echo "<p>Experience : Minimum of <span style='color:red'>".$data['experience']."</span> years</p>";
      echo "<p>Qualifications : ".$data['qualification']."</p>";
      echo "<p>Salary Package : ".$data['salary']."</p>";
      echo "<p>Registration start Date & Time: ".explode(" ",$data['reg_start_date'])[0]." at ".explode(" ",$data['reg_start_date'])[1]."</p>";
      echo "<p>Registration End Date & Time: ".explode(" ",$data['reg_end_date'])[0]." at ".explode(" ",$data['reg_end_date'])[1]."</p>";
      $date = date('Y-m-d H:i:s');
      if(!isset($_COOKIE['user'])){
        echo "<h5>You need to login to apply</h5>";
      }
      else if($role[1]=="seeker"){
        $query="select * from apply where applier_id='$role[0]' and job_id='$jobId'";
        $res = mysqli_query($connect,$query);
        if($row = $res->fetch_assoc()){
          if($row['status']=='Accepted'){
            echo "<p>Interview time : ".$row['schedule']."</p>";
          }
          echo "<button class='btn btn-success'>".$row['status']."</button>";
        }
        else if($data['reg_start_date']<$date && $data['reg_end_date']>$date){
          $action="actions/applyJob.php?id=".$jobId;
          echo '<br><a href='.$action.'><button class="btn btn-primary">Apply</button></a>';
        }
        else{
          echo "<h5>Now you cannot apply for this job</h5>";
        }
      }
      else if($role[1]=="interviewer"){
        if($data['creator_id']==$role[0]){
          $action="applied.php?id=".$jobId;
          echo "<a href=".$action."><button class='btn btn-primary'>View applied candidates</button></a>";
        }
      }
    ?>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>