<?php
if (!isset($_SESSION['username'])) {
  session_start();
}

// initializing variables
$username = "";
$location = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'order_placing_system_db');

// REGISTER USER
if(isset($_POST['reg_user']))
{
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $employeeId = mysqli_real_escape_string($db, $_POST['employeeId']);
  $location = mysqli_real_escape_string($db, $_POST['location']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Name is required"); }
  if (empty($employeeId)) { array_push($errors, "Employee Id is required"); }
  if (empty($location)) { array_push($errors, "Your Location is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM waiters WHERE username='$username' OR employeeId='$employeeId' OR userLocation='$location' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Name already exists");
    }
	if ($user['employeeId'] === $employeeId) {
		array_push($errors, "Employee Id already exists");
	  }

    if ($user['userLocation'] === $location) {
      array_push($errors, "Location already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
	  $query = "INSERT INTO waiters (username, employeeId, userLocation) 
  			  VALUES('$username', '$employeeId', '$location')";
				mysqli_query($db, $query);
				$_SESSION['username'] = $username;
        $_SESSION['employeeId'] = $employeeId;
          $_SESSION['userLocation'] = $location;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}
		}

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$employeeId = mysqli_real_escape_string($db, $_POST['employeeId']);
	$location = mysqli_real_escape_string($db, $_POST['location']);
  
    if (empty($username)) {
        array_push($errors, "Name is required");
    }
	if (empty($employeeId)) {
        array_push($errors, "Your Employee Id is required");
    }
    if (empty($location)) {
        array_push($errors, "Your Location is required");
    }
  
    if (count($errors) == 0) {

        $query = "SELECT * FROM waiters WHERE username='$username' AND employeeId='$employeeId' AND userLocation='$location' ";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['employeeId'] = $employeeId;
          $_SESSION['userLocation'] = $location;
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/employee ID/location combination");
        }
    }
}

  // MAKE REDUCTIONS IN THE DB.
  if (isset($_POST['reduce'])) {
    $countValue = mysqli_real_escape_string($db, $_POST['count']);
    if (empty($countValue)) {
      array_push($errors, "Kindly add an item");
    }

    $numCountValue = (int)$countValue;

    if ($numCountValue < 1) {
      array_push($errors, "You can't order negative items");
    }

    $query = "SELECT * FROM store_db";
    $storeResult = mysqli_query($db, $query);
    $storeDetails = mysqli_fetch_assoc($storeResult);
    
    if(count($errors) == 0) {
      if ($storeDetails['donuts'] > $numCountValue) {
        $donutsInStore = $storeDetails['donuts'] - $numCountValue;
        $reducedDonuts = "UPDATE store_db 
        SET donuts = '$donutsInStore'";
        mysqli_query($db, $reducedDonuts);
        $_SESSION['update'] = "Updated donuts successfully";
      }
    }

  }
  
  ?>