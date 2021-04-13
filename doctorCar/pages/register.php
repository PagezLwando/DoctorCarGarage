<?php
  //login.php
  include ('../db/connection.php');
  $message = '';
  if (isset($_POST["signup"]))
  {
    if (empty($_POST["firstName"]) || empty($_POST["lastName"]))
    {
      $message = '<label class="text-danger"> first name & Last name Field is required</label>';
    }
    elseif (empty($_POST["emailAddress"]) || empty($_POST["phoneNumber"])) 
    {
      $message = '<label class="text-danger"> Email or Number Field is required</label>';
    }
    elseif (empty($_POST["password"]) || empty($_POST["cpassword"])) 
    {
      $message = '<label class="text-danger">Password Field is required</label>';
    }
    else
    {
      $query = "INSERT INTO user (id, firstName, lastName, phoneNumber, emailAddress, password, cpassword) VALUES (:id, :firstName, :lastName, :phoneNumber, :emailAddress, :password, :cpassword)";
      $statement = $connect->prepare($query);
      $statement->execute(
        array(
         ':id'  => $_POST['id'],
         ':firstName' => $_POST['firstName'],
         ':lastName' => $_POST['lastName'],
         ':phoneNumber' => $_POST['phoneNumber'],
         ':emailAddress' => $_POST['emailAddress'],
         ':password' => $_POST['password'],
         ':cpassword' => $_POST['cpassword'],
      ));

      $results = $statement->fetchAll();
      if (isset($results))
      {
        $_SESSION["id"] = $row['id'];
        $_SESSION["firstName"] = $row['firstName'];
        $_SESSION["lastName"] = $row['lastName'];
        $_SESSION["emailAddress"] = $row['emailAddress'];
        header("location: welcome.php");
      }
      else
      {
        $message = '<label class="text-danger">Not logged in</label>';
        header("location: login.php");
      }
    }
  }
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Register | Doctor Car</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
      <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../css/styles.css">
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
            <a class="navbar-brand" href="#myPage">HOME</a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li ><a href="login.php">Login</a></li> 
              <li ><a href="register.php">Register</a></li>
              <li class="drop"><a href="#Account">Account</a></li>
              <li>
                <a href="../index.html" data-toggle="tooltip" title="Go back Home">
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
      <hr>
      <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="panel panel-default">
                <div class="panel-heading text-center" id="wrapper">
                  REGISTER
                 <div class="row"></div>
                </div>
                <div class="panel-body">
                  <form action="register.php" method="POST" autocomplete="on">
                  <span class="text-danger"><?php echo $message; ?></span>
                    <div class="form-group">
                      <label>First name:</label>
                      <input type="text" name="firstName" placeholder="First name:" id="firstname" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Last name:</label>
                      <input type="text" name="lastName" placeholder="Last name:" id="lastname" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Phone Number:</label>
                      <input type="text" name="phoneNumber" placeholder="Phone Number:" id="phoneNumber" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>User email</label>
                      <input type="text" name="emailAddress" placeholder="Email Address:" id="email" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Password:</label>
                      <input type="password" name="password" value="" placeholder="Password:" id="Password" class="form-control" />
                    </div>
                    <div>
                      <label>Confirm Password:</label>
                      <input type="password" name="cpassword" class="form-control" placeholder="Confirm password:" required  id="cpassword" oninput="check(this)"/>
                      <script language='javascript' type='text/javascript'>
                        function check(input) {
                          if (input.value !== document.getElementById('password').value){
                                  input.setCustomValidity('Passwords do not Match.');
                                }
                                else{
                                    // input is valid -- reset the error message
                                    input.setCustomValidity('');
                                  }
                                }
                      </script>
                      </div>
                    <br>
                    <div class="form-group">
                      <input type="submit" name="signup" id="signup" class="btn btn-info" value="Sign up" />
                      <input type="reset" name="reset" id="reset" class="btn btn-default" value="Cancel" />
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