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
    </ul>
  </div>
  </nav>
  <div class="container" style="margin-top:30px">
    <?php
      if(!isset($_COOKIE['user'])){
        header("Location: login.php");
      }
      else{
        $cookieParts=explode(" ",$_COOKIE['user']);
        include 'database/connection.php';
        $query="select * from people where id=".$cookieParts[0].";";
        $res = mysqli_query($connect,$query);
        if(!$res){
          echo mysqli_error($connect);
        }
        $data = $res->fetch_assoc();
        echo "<h1>Hello, ".$data['name']."</h1>";
        echo "<p>".$data['email']."</p>";
        echo "<h4>Your details : </h4>";
        $role = $cookieParts[1];
        echo "<p>Role : ".$role."</p>";
        echo "<p?>Mobile No : ".$data['phone']."</p>";
        if($role=="seeker"){
          echo "<p?>Current status : ".$data['additionalField1']."</p><p?>Skills : ".$data['additionalField2']."</p>";
        }
        else{
          echo "<p?>Working at : ".$data['additionalField1']."</p><p?>Work Experience : ".$data['additionalField2']."Year(s)</p>";
        }
      }
    ?>
    <form class="form" action="login.php">
      <button class="btn btn-danger" type="submit">Log out</button>
    </form>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>