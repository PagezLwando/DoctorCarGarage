<?php
  //login.php
  include ('../db/connection.php');
  $message = '';
  if (isset($_POST["login"]))
  {
    if (empty($_POST["emailAddress"]) || empty($_POST["password"]))
    {
      $message = '<label class="text-danger"> Both fields are required </label>';
    }
    else
    {

      $query = "SELECT * FROM user WHERE emailAddress = :emailAddress";
      $statement = $connect->prepare($query);
      $statement->execute(array('emailAddress' => $_POST["emailAddress"]));
      $count = $statement->rowCount();
      if ($count > 0)
      {
        $results = $statement->fetchAll();
        foreach ($results as $row)
        {
          if ($_POST['password'] == $row['password'])
          {
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            header("location: welcome.php");
          }
          else
          {
            $message = '<label class="text-danger">Wrong Email Address or password</label>';
          }
        }
      }
      else
      {
        $message = '<label class="text-danger">Email Address or password is wrong</label>';
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login | Doctor Car</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/w3.css">
    <link rel="shortcut icon" href="../images/favicon.ico"/>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                   
          </button>
          <a class="navbar-brand" href="../index.html">HOME</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="login.php">Login</a></li> 
            <li ><a href="register.php">Register</a></li>
            <li class="drop"><a href="#Account">Account</a></li>
            <li><a href="../index.html" data-toggle="tooltip" title="Go back Home">
              <span class="glyphicon glyphicon-home"></span>
            </a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Jumbotron -->    
    <div class="jumbotron jumbotron-fluid text-center">
      <h1>Doctor Car Garage</h1> 
      <h6 style="font-size: 24px;"><i>Simply washed & Repaired Perfect on the go</i></h6>
    </div>
    <div class="container">
      
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading text-center" id="wrapper">
          LOGIN
        </div>
        <div class="panel-body">
          <form method="POST" action="login.php" autocomplete="off">
            <span class="text-danger"><?php echo $message; ?></span>
            <div class="form-group">
              <label>User email</label>
              <input type="text" name="emailAddress" value="" placeholder="Email:" id="email" class="form-control" />
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" value="" placeholder="Password:" id="password" class="form-control" />
            </div>
            <div class="form-group">
              <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
              <input type="reset" name="reset" id="reset" class="btn btn-default" value="Cancel" />
              <p class="keeplogin"> 
                <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                <label for="loginkeeping">Keep me logged in</label>
              </p>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
      </div>
    </div>    
    <!-- Footer -->
     <footer class="footer container-fluid text-center">
      <a href="#myPage" title="To Top">
        <span class="roundchervon glyphicon glyphicon-chevron-up"></span>
      </a>
      <div class="row">
        <div class="col-sm-3">
          <h4>Doctor Car Garage</h4>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p><br>
          <a href="#"><span class="fa fa-twitter-square" style="font-size:40px;"></span></a>
          <a href="#"><span class="fa fa-facebook-square" style="font-size:40px"></span></a>
          <a href="#"><span class="fa fa-pinterest-square" style="font-size:40px"></span></a>
          <a href="#"><span class="fa fa-youtube-square" style="font-size:40px"></span></a>
          <a href="#"><span class="fa fa-instagram" style="font-size:40px"></span></a>
        </div>
        <div class="col-sm-3" style="font-family: Arial, Helvetica, sans-serif;">
          <h4>Services</h4>
            <li>Oil Change</li>
            <li>Batteries</li>
            <li>Tow Truck</li>
            <li>Tire Change</li>
            <li>Engine Repair</li>
            <li>Car Maintenance </li>
          <span><a href="#">Privacy Policy</a> | <a href="#">Terms of use</a></span>
        </div>
        <div class="col-sm-3">
          <h4>Business Hours</h4>
          <p>
            <h6><strong>Opening Days:</strong></h6>
                Monday – Friday : 9am to 5pm<br>
                Saturday : 9am to 1pm<br>
                Sunday : Closed
            <h6><strong>Vacations:</strong></h6>
                All Sunday Days All Official Holidays
          </p>
        </div>
        <div class="col-sm-3">
          <h4>Contact Information</h4>
            <p><span class="glyphicon glyphicon-phone"></span>+27 71 724 7607</p>
            <p><span class="glyphicon glyphicon-envelope"></span> doctorcar@gmail.com</p>
            <p><span class="glyphicon glyphicon-map-marker"></span> 120 Strand Str, Cape Town, RSA</p>
        </div>
      </div><hr>
      <div align="center">
        <span align="center">Developed by <a href="https://nodumeholdings.000webhostapp.com" target="_blank">nodumelwando inc.</a> &copy Copyright 2021.</span>
      </div>
  </footer>
  </body>
</html>