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
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jobs.php">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">About</a>
      </li>
    </ul>
    <ul class="navbar-nav" style="margin-left:500px">
      <?php
        if (!isset($_COOKIE['user'])) {
          header("Location: http://localhost/jobApp/login.php");
          echo '<li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>';
        }
        else{
          if(explode(" ",$_COOKIE['user'])[1]=="interviewer"){
            echo '<li class="nav-item">
              <a class="nav-link" href="createJob.php">Create</a>
            </li>';
          }
          else{
            header("Location: http://localhost/jobApp/login.php");
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
  <div class="container">
    <button class="btn btn-warning" onclick="javascript:history.go(-1)">> Back</button>
    <h3>Applied candidates</h3>
    <?php
      $response=$_GET["id"];
      include 'database/connection.php';
      $query = "select * from people where id in (select applier_id from apply where job_id='$response' order by id desc)";
      $res = mysqli_query($connect,$query);
      while($data = $res->fetch_assoc()){
        echo '<div class="card" style="width: 80%;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$data['name'].'</h5>';
        echo "<p>".$data['email']."</p>";
        echo "<h4>Other Details : </h4>";
        echo "<p>Role : ".$data['role']."</p>";
        echo "<p>Mobile No : ".$data['phone']."</p>";
        echo "<p>Current status : ".$data['additionalField1']."</p><p>Skills : ".$data['additionalField2']."</p>";
        $id=$data['id'];
        $simpleQuery = "select * from apply where job_id=$response and applier_id=$id";
        $ans = mysqli_query($connect,$simpleQuery)->fetch_assoc();
        if($ans['status']=='Applied'){
          $actionPos = "schedule.php?redirect=".$response."&id=".$ans['id']."&res=Accepted";
          $actionNeg = "schedule.php?redirect=".$response."&id=".$ans['id']."&res=Rejected";
          echo "<a href=".$actionPos."><button class='btn btn-success'>Accept</button></a>
          <a href=".$actionNeg."><button class='btn btn-danger'>Reject</button></a>";
        }
        else if($ans['status']=='Accepted'){
          echo "<p>Interview time : ".$ans['schedule']."</p>";
        }
        echo "<p>Current Status : ".$ans['status']."</p>";
        echo '</div></div>';
      }
    ?>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>