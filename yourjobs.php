<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JOB APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="static/style.css">
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
          header("Location: login.php");
        }
        else{
          if(explode(" ",$_COOKIE['user'])[1]=="interviewer"){
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
  </div>
  </nav>
  <div class="container margin-fix">
    <?php
      $role=explode(" ",$_COOKIE['user']);
      include 'database/connection.php';
      if($role[1]=="interviewer"){
        echo "<h3>Your created Jobs</h3>";
        $query="select job_id,role,company_name,reg_start_date,reg_end_date from job where creator_id='$role[0]';";
      }
      else if($role[1]=="seeker"){
        echo "<h3>Your Applied Jobs</h3>"; 
        $query="select * from job where job_id in (select job_id from apply where applier_id='$role[0]');";
      }
      $res = mysqli_query($connect,$query);
      $count=1;
      while($row = $res->fetch_assoc()){
        if(($count-1)%3==0){
          echo '<div class="row">';
        }
        echo '<div class="card" style="width: 18rem;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row['role'].'</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">From '.$row['company_name'].'</h6>';
        echo '<p>Starts from '.$row['reg_start_date'].'</p>';
        echo '<p>to '.$row['reg_end_date'].'</p>';
        echo '<a href="particularJob.php?id='.$row['job_id'].'">View full details</a>';
        echo '</div></div>';
        if(($count-1)%3==2){
          echo '</div>';
        }
        $count+=1;
      }
    ?>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>