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
    <ul class="navbar-nav" style="margin-left:600px">
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
    </ul>
  </div>
  </nav>
  <form class="login-form" method="POST" action="actions/registerAction.php">
    <div class="form-group">
      <label for="exampleFormControlInput1">Email address</label>
      <input type="email" name="email" class="form-control" placeholder="Enter Email">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Full Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Mobile Number</label>
      <input type="number" name="phone" class="form-control" placeholder="Enter Number">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Set Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter Password">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Confirm Password</label>
      <input type="password" name="confirmPassword" class="form-control" placeholder="Re-Enter Password">
    </div>
    <div class="form-group">
      <label>Select Role</label>
      <select class="form-control" name="role">
        <option value=""></option>
        <option value="seeker">Job Seeker</option>
        <option value="interviewer">Job Interviewer</option>
      </select>
    </div>
    <div class="additional-form-group">
    </div>
    <button type="submit" class="btn btn-warning">Submit</button>
  </form>
  <?php
    if (isset($_COOKIE['user'])) {
      echo "<h5>You have to logIn again to continue</h5>";
      unset($_COOKIE['user']);
      setcookie('user', '', time() - 3600, '/');
    }
  ?>
<script src="static/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>