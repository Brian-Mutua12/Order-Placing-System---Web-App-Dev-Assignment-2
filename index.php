<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
	include("connect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style 2.css">
    <link rel="stylesheet" type="text/css" href="./modal.css">
    <title>JKUAT EATS HOMEPAGE</title>
</head>
<body>
<a href="index.php?logout='1'">Logout</a>
    <article class="flow">
        <h1>JKUAT EATS MENU</h1><br><br>
        <br>	
      <div class="result">
<!-- Check if the session variable was set -->
      <?php if(isset($_SESSION['username']).($_SESSION['employeeId']).($_SESSION['userLocation'])) { ?>
          <table class="tbl" style="width:400px">
            <tr class="tr">
              <th class="th">JKUAT EATS EMPLOYEE <br><br></th>
            </tr>
              <tr class="tr">
                  <td>Name: </td>
                  <td><?= $_SESSION['username'] ?></td>
              </tr>
              <tr class="tr">
                  <td>Employee Id: </td>
                  <td><?= $_SESSION['employeeId'] ?></td>
              </tr>
              <tr class="tr">
                  <td>Location: </td>
                  <td><?= $_SESSION['userLocation'] ?></td>
              </tr>
          </table>
      <?php }
      else { echo "You haven't login yet!!"; }?> </div>
      
      <?php if(isset($_SESSION['update'])) { ?>
        <p><strong><?= $_SESSION['update'] ?></strong></p>
      <?php } ?>
    <br>
        <p>Select meal type to begin order placement .</p>
        <?php include('errors.php'); ?>
        <div class="team">
          <ul class="auto-grid" role="list">

            <li>
              <div class="profile" id="menu-item-1">
                <h2 class="profile__name">BREAKFAST</h2>
                <p>JKUAT EATS</p>
                <img alt="BREAKFAST" src="breakfast.jpg" />
              </div>
            </li>

            <li>
              <div class="profile" id="menu-item-2">
                <h2 class="profile__name">LUNCH</h2>
                <p>JKUAT EATS</p>
                <img alt="LUNCH" src="lunch.jpg" />
              </div>
            </li>

            <li>
              <div class="profile" id="menu-item-3">
                <h2 class="profile__name">DINNER</h2>
                <p>JKUAT EATS</p>
                <img alt="DINNER" src="dinner.jpg" />
              </div>
            </li>

            <li>
              <div class="profile" id="menu-item-4">
                <h2 class="profile__name">BEVERAGES</h2>
                <p>JKUAT EATS</p>
                <img alt="BEVERAGES" src="beverages.jpg" />
              </div>
            </li>
          </ul>
        </div>
      </article>

      <div id="my-modal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Kindly select the quantity: </h2>
          </div>
          <div class="modal-body">
            <h4 class="food-type"></h4>
            <form method="post" action="index.php">
              <div class="count">
                <span id="add">+</span>
                <input type="text" id="count-input" name="count" placeholder="0">
                <span id="subtract">-</span>
              </div>
              <button class="submit-btn" name="reduce">Submit</button>
            </form>
          </div>
        </div>
    </div>
<script src="./index.js"></script>
</body>
</html>