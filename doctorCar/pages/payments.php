<?php
  //index.php
  include ('../db/connection.php');
  if (!isset($_SESSION["id"])) {
    header("location: login.php");
  }
require_once("../db/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["code"] == $k) {
                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
              }
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
  case "remove":
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["code"] == $k)
            unset($_SESSION["cart_item"][$k]);        
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  break;
  case "empty":
    unset($_SESSION["cart_item"]);
  break;  
}
}
  $message = '';
  if (isset($_POST["submitOrder"]))
  {
    if (empty($_POST["firstName"]) || empty($_POST["lastName"]))
    {
      $message = '<label class="text-danger">Field is required</label>';
    }
    elseif (empty($_POST["emailAddress"]) || empty($_POST["password"])) 
    {
      $message = '<label class="text-danger">Field is required</label>';
    }
    elseif (empty($_POST["category"]) || empty($_POST["gender"])) 
    {
      $message = '<label class="text-danger">Field is required</label>';
    }
    elseif (empty($_POST["phoneNumber"])) 
    {
      $message = '<label class="text-danger">Field is required</label>';
    }
    else
    {
      $query = "INSERT INTO orderdetails (user_id, firstName, lastName, emailAddress, phoneNumber, address) VALUES (:user_id, :firstName, :lastName, :emailAddress, :phoneNumber, :address)";
      $statement = $connect->prepare($query);
      $statement->execute(
        array(
         ':user_id'  => $_POST['user_id'],
         ':firstName' => $_POST['firstName'],
         ':lastName' => $_POST['lastName'],
         ':emailAddress' => $_POST['emailAddress'],
         ':phoneNumber' => $_POST['phoneNumber'],
         ':address' => $_POST['address'],
      ));

      $results = $statement->fetchAll();
      if (isset($results))
      {
        $_SESSION["user_id"] = $row['user_id'];
        $_SESSION["firstName"] = $row['firstName'];
        $_SESSION["lastName"] = $row['lastName'];
        $_SESSION["emailAddress"] = $row['emailAddress'];
        header("location: action_page.php");
      }
      else
      {
        $message = '<label class="text-danger">Not logged in</label>';
        header("location: payments.php");
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payments | Doctor Car</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/favicon.ico"/>
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.7/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
  <link type="text/css" rel="stylesheet" href="../css/style.css"/>
  <link type="text/css" rel="stylesheet" href="../css/styles.css"/>
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<style type="text/css">
  .row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}
.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}
label {
  margin-bottom: 10px;
  display: block;
}
span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
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
          <li class="drop"><a href="#pricing" data-toggle="tooltip" title="Your Wishlist!">
          <li class="drop"><a href="welcome.php" data-toggle="tooltip" title="Go back Home"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="drop"><a href="login.php" data-toggle="tooltip" title="Log Out"><span class="glyphicon glyphicon-log-out"></span></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->    
    <div class="jumbotron text-center">
      <h1>Doctor Car Garage</h1> 
      <h6 style="font-size: 24px;"><i>Simply washed & Repaired Perfect on the go</i></h6>
      <br>
      <form action="#" method="post" class="form-inline">
          <select class="form-control">
              <option name="--Select--">Filter By Department</option>
              <option name="OfficeAndStationery">Seat Covers</option>
              <option name="HomeAndKitchen">Boot and Bonet</option>
              <option name="HealthAndBeauty">Wheels & Tires</option>
              <option name="BabyAndToddler">Electric Systems</option>
              <option name="MoviesAndSeries">Brakes & Brake Pads</option>
              <option name="FrozenFood">Engine & GearBox</option>
              <option name="LiquorAndDrinks">Servicing</option>
          </select>
      <input type="text" class="form-control" size="50" placeholder="Search..." required>
      <a href="#"><button type="button" class="btn btn-default glyphicon glyphicon-search"></button></a>
    </form>
    <?php if (isset($_SESSION["emailAddress"])): ?>
      <p style="color: white;">
        Welcome <strong><?php echo $_SESSION["firstName"]; echo $_SESSION["lastName"];?></strong></p>
    <?php endif ?>
  </div>
  <!-- Checkout Starts here... -->
  <div class="row container-fluid" style="background-color: lightgrey;">
    <form action="action_page.php" method="POST">
    <div class="col-md-6">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
        <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
        ?>  
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
          <tbody>
            <tr>
              <th style="text-align:left;">Name</th>
              <th style="text-align:left;">Code</th>
              <th style="text-align:right;" width="5%">Quantity</th>
              <th style="text-align:right;" width="10%">Unit Price</th>
              <th style="text-align:right;" width="10%">Price</th>
              <th style="text-align:center;" width="5%">Remove</th>
            </tr> 
            <?php   
              foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
              ?>
                <tr>
                <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image img-thumbnail img-sm" style="width: 20%; height: 20%;"/>
                  <?php echo $item["name"]; ?></td>
                <td><?php echo $item["code"]; ?></td>
                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                <td style="text-align:center;"><a href="payments.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
              }
              ?>
            <tr>
              <td colspan="2" align="right">Total:</td>
              <td align="right"><?php echo $total_quantity; ?></td>
              <td align="right" colspan="2">
                <strong><?php echo "$ ".number_format($total_price, 2); }?></strong>
              </td>
              <td></td>
            </tr>
            <tr>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <div class="row">
        <div class="col-md-6">
          <h3>Billing Address</h3>
          <label for="fname"><i class="fa fa-user"></i> Full Name</label>
          <input type="text" id="fname" class="form-control" name="firstname" placeholder="John M. Doe">
          <label for="email"><i class="fa fa-envelope"></i> Email</label>
          <input type="text" id="email" class="form-control" name="email" placeholder="john@example.com">
          <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
          <input type="text" id="adr" class="form-control" name="address" placeholder="542 W. 15th Street">
          <label for="city"><i class="fa fa-institution"></i> City</label>
          <input type="text" id="city" class="form-control" name="city" placeholder="New York">
          <div class="row">
            <div class="col-md-6">
              <label for="state">State</label>
              <input type="text" id="state" class="form-control" name="state" placeholder="NY">
            </div>
            <div class="col-md-6">
              <label for="zip">Zip</label>
              <input type="text" id="zip" class="form-control" name="zip" placeholder="10001">
            </div>
          </div>
          <label class="form-group">
            Use Same Address?:  <input type="checkbox" name="sameadr" />
          </label>
        </div>
        <div class="col-md-6">
          <h3>Payment</h3>
          <label for="cname">Name on Card</label>
          <input type="text" id="cname" class="form-control" name="cardname" placeholder="John More Doe">
          <label for="ccnum">Credit card number</label>
          <input type="text" id="ccnum" class="form-control" name="cardnumber" placeholder="1111-2222-3333-4444">
          <label for="expmonth">Exp Month</label>
          <input type="text" id="expmonth" class="form-control" name="expmonth" placeholder="September">
          <div class="row">
            <div class="col-md-6">
              <label for="expyear">Exp Year</label>
              <input type="text" id="expyear" class="form-control" name="expyear" placeholder="2018">
            </div>
            <div class="col-md-6">
              <label for="cvv">CVV</label>
              <input type="text" id="cvv" class="form-control" name="cvv" placeholder="352">
            </div>
          </div>
          <label for="fname">Accepted Cards</label>
          <div class="icon-container">
            <i class="fa fa-cc-visa" style="color:navy;"></i>
            <i class="fa fa-cc-amex" style="color:blue;"></i>
            <i class="fa fa-cc-mastercard" style="color:red;"></i>
            <i class="fa fa-cc-discover" style="color:orange;"></i>
            <i class="fa fa-cc-cryptocurrency" style="color:red;"></i>
            <i class="fa fa-cc-discover" style="color:orange;"></i>
          </div>
          <div class="form-group">
            <input type="submit" name="submitOrder" id="Checkout" value="Checkout" class="btn btn-lg btn-success" style="text-align: right;">
            <a href="welcome.php"><button class="btn btn-lg btn-warning" style="text-align: right;">Back to Cart</button></a>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
    <hr>   
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