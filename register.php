<?php 
    require 'config/config.php';
    require 'includes/form_handlers/register_handler.php'
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>  

<form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name"
        value="<?php
            if(isset($_SESSION['reg_fname'])) {
                echo $_SESSION['reg_fname'];
            }
        ?>" required>
    <br>
    <?php if(in_array("Your first name must be btwn 2 and 25 characters<br>", $error_array)) echo "Your first name must be btwn 2 and 25 characters<br>"; ?>
    <input type="text" name="reg_lname" placeholder="Last Name"
        value="<?php
            if(isset($_SESSION['reg_lname'])) {
                echo $_SESSION['reg_lname'];
            }
        ?>" required>
    <br>
    <?php if(in_array("Your last name must be btwn 2 and 25 characters<br>", $error_array)) echo "Your last name must be btwn 2 and 25 characters<br>"; ?>
    <input type="email" name="reg_email" placeholder="Email"
        value="<?php
            if(isset($_SESSION['reg_email'])) {
                echo $_SESSION['reg_email'];
            }
        ?>" required>
    <br>
    <?php if(in_array("Email is already in use<br>", $error_array)) echo "Email is already in use<br>";
        else if(in_array("Invalid format</br>", $error_array)) echo "Invalid format</br>";
        else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>
    <input type="email" name="reg_email2" placeholder="Confirm Email"
        value="<?php
            if(isset($_SESSION['reg_email2'])) {
                echo $_SESSION['reg_email2'];
            }
        ?>" required>
    <br>
    <input type="password" name="reg_password" placeholder="Password" required>
    <br>
    <?php if(in_array("Your password can only contain english characters or number<br>", $error_array)) echo "Your password can only contain english characters or number<br>";
    else if(in_array("Your password must be btwn 5 and 30 characters<br>", $error_array)) echo "Your password must be btwn 5 and 30 characters<br>";
    else if(in_array("Your passwords don't match<br>", $error_array)) echo "Your passwords don't match<br>"; ?>
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br>
    <input type="submit" name="register_button" placeholder="Confirm Password" valcue="Register">
    <br>
    <?php if(in_array("<span>You're all set!</span>", $error_array)) echo "<span>You're all set!</span>"; ?>
</form>
    
</body>
</html>