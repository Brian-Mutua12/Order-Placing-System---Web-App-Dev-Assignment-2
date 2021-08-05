<?php 
	include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>LOGIN JKUAT EATS</title>
</head>
<body>
    <div class="container">
        <p class="login-text">JKUAT EATS NEW EMPLOYEE SIGNUP</p><br>
       
        <form class="login" method="post" action="signup.php">
        <?php include('errors.php'); ?>

            <p class="login-text">Enter your Name</p>
            <div class="input-group">
                <input type="text" name="username" placeholder="Name" 
                 value="<?php echo $username; ?>">
            </div><br>

            <p class="login-text">Enter your Employee ID</p>
            <div class="input-group">
                <input type="number" name="employeeId" placeholder="Employee ID">
            </div><br>

            <p class="login-text">Enter your Location</p>
            <div class="input-group">
                <input type="text" name="location" placeholder="Location"
                value="<?php echo $location; ?>">
            </div><br><br>

            <div class="input-group">
                 <button type="submit" class="btn" name="reg_user">Signup</button>
            </div><br><br>

            <div class="input-group">
                <button class="btn"> <a href="login.php"> Login</a></button><br>
            
                <input type="reset">
            </div>

        </form>
    </div>
</body>
</html>