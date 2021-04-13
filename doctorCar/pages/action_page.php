<?php
  //index.php
  include ('../db/connection.php');
  if (!isset($_SESSION["id"])) {
    header("location: login.php");
  }
  ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Thank you | Doctor Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/favicon.ico"/>
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.7/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/styles.css"/>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
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
            <li><a href="#Account">Account</a></li>
            <li><a href="welcome.php" data-toggle="tooltip" title="Go back Home"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="login.php" data-toggle="tooltip" title="Log Out"><span class="glyphicon glyphicon-log-out"></span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron jumbotron-fluid text-center">
      <h1>Doctor Car Garage</h1> 
      <h6 style="font-size: 24px;"><i>Simply washed & Repaired Perfect on the go</i></h6>
    </div>
    <br>
    <br>
    <h1><center>Thank you for using our Website</center></h1>
    <h2 class="text-center">Your Orders is recorded.. We will let you know when to expect your Orders</h2>
  </body>

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
</html>
