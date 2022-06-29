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
          header("Location: http://localhost/jobApp/profile.php");
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
            </li>
            <li class="nav-item">
              <a class="nav-link" href="yourjobs.php">User jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>';
          }
          else{
            header("Location: http://localhost/jobApp/profile.php");
          }
        }
      ?>
    </ul>
  </div>
  </nav>
  <form class="login-form" action="actions/createJobAction.php" method="POST">
    <div class="form-group">
      <label for="exampleFormControlInput1">Company Name</label>
      <input type="text" name="company" class="form-control" id="exampleFormControlInput1" placeholder="Enter company">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Registration Start Date</label>
      <input type="datetime-local" name="regStart" class="form-control" id="exampleFormControlInput1" placeholder="Enter Start date">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Registration End Date</label>
      <input type="datetime-local" name="regEnd" class="form-control" id="exampleFormControlInput1" placeholder="Enter End date">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Years of Experience required</label>
      <input type="number" name="experience" class="form-control" id="exampleFormControlInput1" placeholder="Enter Experience needed">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Qualifications</label>
      <input type="text" name="qualification" class="form-control" id="exampleFormControlInput1" placeholder="Enter Qualifications needed">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Job Role</label>
      <input type="text" name="role" class="form-control" id="exampleFormControlInput1" placeholder="Enter role of job">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Salary package</label>
      <input type="text" name="salary" class="form-control" id="exampleFormControlInput1" placeholder="Enter salary">
    </div>
    <button type="submit" class="btn btn-warning">Submit</button>
  </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>