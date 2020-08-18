<?php 
    session_start();
    $con = mysqli_connect("localhost", "root", "", "social");

    if(mysqli_connect_errno()) {
        echo "failed to connect: " . mysqli_connect_errno();
    }

    //Declare variables to prevent errors
    $fname          =   "";
    $lname          =   "";
    $em             =   "";
    $em2            =   "";
    $password       =   "";
    $password2      =   "";
    $date           =   ""; // sign up date
    $error_array    =   ""; // holds error messages

    if(isset($_POST['register_button'])) {
        $fname = strip_tags($_POST['reg_fname']);   // remove html tags from the input
        $fname = str_replace(' ','',$fname);        // remove extra space
        $fname = ucfirst(strtolower($fname));       // lowercase -> first letter uppercase
        $_SESSION['reg_fname'] = $fname;             // stores first name into session variable

        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(' ','',$lname);     
        $lname = ucfirst(strtolower($lname)); 
        $_SESSION['reg_lname'] = $lname;

        $em = strip_tags($_POST['reg_email']);
        $em = str_replace(' ','',$em);     
        $em = ucfirst(strtolower($em));
        $_SESSION['reg_em'] = $em;

        $em2 = strip_tags($_POST['reg_email2']);
        $em2 = str_replace(' ','',$em2);     
        $em2 = ucfirst(strtolower($em2));
        $_SESSION['reg_em2'] = $em2;

        $password = strip_tags($_POST['reg_password']);
        $password2 = strip_tags($_POST['reg_password2']);

        $date = date("Y-m-d");                      // current date

        // check if emails are equal
        if ($em == $em2) {
            // check if email is a valid form
            if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);
                
                // check if email already exist
                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
                // check the number of rows
                $num_rows = mysqli_num_rows($e_check);
                if ($num_rows > 0) {
                    echo "Email is already in use";
                }
            } else {
                echo "Invalid format";
            }
        } else {
            echo "Emails don't match";
        }

        // validate form
        if (strlen($fname) > 25 || strlen($fname) < 2) {
            echo "Your first name must be btwn 2 and 25 characters";
        }
        if (strlen($lname) > 25 || strlen($lname) < 2) {
            echo "Your last name must be btwn 2 and 25 characters";
        }
        if ($password != $password2) {
            echo "Your passwords don't match";
        } else {
            if (preg_match('/[^A-Za-z0-9]/', $password)) {
                echo "Your password can only contain english characters or number";
            }
        }
        if (strlen($password) > 30 || strlen($lname) < 5) {
            echo "Your last name must be btwn 2 and 25 characters";
        }
    }
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
    <input type="text" name="reg_lname" placeholder="Last Name"
        value="<?php
            if(isset($_SESSION['reg_lname'])) {
                echo $_SESSION['reg_lname'];
            }
        ?>" required>
    <br>
    <input type="email" name="reg_email" placeholder="Email"
        value="<?php
            if(isset($_SESSION['reg_email'])) {
                echo $_SESSION['reg_email'];
            }
        ?>" required>
    <br>
    <input type="email" name="reg_email2" placeholder="Confirm Email"
        value="<?php
            if(isset($_SESSION['reg_email2'])) {
                echo $_SESSION['reg_email2'];
            }
        ?>" required>
    <br>
    <input type="password" name="reg_password" placeholder="Password" required>
    <br>
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br>
    <input type="submit" name="register_button" placeholder="Confirm Password" valcue="Register">
</form>
    
</body>
</html>