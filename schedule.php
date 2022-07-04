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
          header("Location: login.php");
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
            header("Location: login.php");
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
      $response=$_GET;
      $id=$response["id"];
      $res=$response["res"];
      $redirect=$response["redirect"];
      include 'database/connection.php';
      $query = "update apply set status='$res' where id='$id'";
      mysqli_query($connect,$query);
      if($res=="Rejected"){
        header("Location: applied.php?id=".$redirect);
      }
      else{
        $action = "actions/updateStatus.php?id=".$id."&res=".$res."&redirect=".$redirect;
        echo "<form class='form' action=".$action." method='POST'>";
        echo  '<label class="form-label">Enter interview time</label>';
        echo '<input class="form-control" type="datetime-local" name="scheduleTime">';
        echo '<button class="btn btn-warning">Submit</button>';
      }
    ?>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>