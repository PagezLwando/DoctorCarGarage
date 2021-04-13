<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart | Doctor Car</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/favicon.ico"/>
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../css/w3.css">
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<style>
    .product{
    padding-bottom: 40px;
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
          <a class="navbar-brand" href="../index.html">HOME</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="instructions.php">Instructions</a></li>
            <li ><a href="login.php">Login</a></li>
            <li ><a href="register.php">Register</a></li>
            <li class="drop"><a href="#Account">Account</a></li>
            <li><a href="#pricing" data-toggle="tooltip" title="Your Wishlist!"><button class="btn btn-success btn-sm" type="button"><span id="wishlist" class="glyphicon glyphicon-heart"> 0 </span></button></a></li>
            <li><a href="#contact" data-toggle="tooltip" title="Your Cart!"><button class="btn btn-danger  btn-sm" type="button"><span class="glyphicon glyphicon-shopping-cart"> 0 </span></button></a></li>
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

  <!-- Container (Shooping Section) -->
  <div id="shopping-cart">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="txt-heading">Shopping Cart</div>
      </div>
      <div class="panel-body">
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
<th style="text-align:right;" width="5%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="10%">Remove</th>
<th style="text-align:center;" width="10%">Cart</th>
</tr> 
<?php   
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
    ?>
        <tr>
        <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image img-thumbnail img-sm" style="width: 10%; height: 10%;"/><?php echo $item["name"]; ?></td>
        <td><?php echo $item["code"]; ?></td>
        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
        <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
        <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
        <td style="text-align:center;"><a href="welcome.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
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
  <strong><?php echo "$ ".number_format($total_price, 2); ?></strong>
</td>
<td></td>
<td>
  <span style="text-align: right;">
        <?php $Checkout = '<a href="payments.php"><button class="btn btn-md btn-success">Checkout</button></a>';
        echo $Checkout; ?>
      </span>
        <a id="btnEmpty" href="welcome.php?action=empty"><button class="btn btn-md btn-danger ">Empty Cart</button></a>
</td>
</tr>
<tr>
</tr>
</tbody>
</table>    
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>
      </div>
      <div class="panel-footer">
      </div>
    </div>

<div id="product-grid">
  <div class="txt-heading"><h3>Products</h3></div>
  <?php
  $product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY product_id ASC LIMIT 30");
  if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){
  ?>
  <div class="panel panel-default text-center container">
    <div class="product-item">
      <form method="post" action="welcome.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
      <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" class="img-thumbnail img-sm" style="width: 30%; height: 30%;"></div>
      <div class="product-tile-footer panel-footer">

      <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
      <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
      <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction btn btn-primary btn-sm"/></div>
      </div>
      </form>
    </div>
  </div>
  <?php
    }
  }
  ?>
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