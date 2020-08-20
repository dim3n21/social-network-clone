<?php
//Declare variables to prevent errors
    $fname          =   "";
    $lname          =   "";
    $em             =   "";
    $em2            =   "";
    $password       =   "";
    $password2      =   "";
    $date           =   ""; // sign up date
    $error_array    =   array(); // holds error messages

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
        $_SESSION['reg_email'] = $em;

        $em2 = strip_tags($_POST['reg_email2']);
        $em2 = str_replace(' ','',$em2);     
        $em2 = ucfirst(strtolower($em2));
        $_SESSION['reg_email2'] = $em2;

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
                    array_push($error_array, "Email is already in use<br>");
                }
            } else {
                array_push($error_array, "Invalid format</br>");
            }
        } else {
            array_push($error_array, "Emails don't match<br>");
        }

        // validate form
        if (strlen($fname) > 25 || strlen($fname) < 2) {
            array_push($error_array, "Your first name must be btwn 2 and 25 characters<br>");
        }
        if (strlen($lname) > 25 || strlen($lname) < 2) {
            array_push($error_array, "Your last name must be btwn 2 and 25 characters<br>");
        }
        if ($password != $password2) {
            array_push($error_array, "Your passwords don't match<br>");
        } else {
            if (preg_match('/[^A-Za-z0-9]/', $password)) {
                array_push($error_array, "Your password can only contain english characters or number<br>");
            }
        }
        if (strlen($password) > 30 || strlen($password) < 5) {
            array_push($error_array, "Your password must be btwn 5 and 30 characters<br>");
        }

        if (empty($error_array)) {
            // encrypt password with md5
            $password = md5($password);
            
            // generate username by concatenation first name and last name
            $username = strtolower($fname . "_" . $lname);
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'") ?? 0;
            
            $i = 0;
            // if username exists add number to username
            while(mysqli_num_rows($check_username_query) != 0) {
                $i++;
                $username = $username . '_' . $i;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username") ?? 0;
            }
            
            //profile picture assignment
            $rand = rand(1,2);
            if ($rand == 1) {
                $profile_pic = "assets/images/profile_pics/defaults/1.png";
            } else if ($rand == 2) {
                $profile_pic = "assets/images/profile_pics/defaults/2.png";
            }
            
            $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
            array_push($error_array, "<span>You're all set!</span>");

            // clear session variables
            $_SESSION['reg_fname']   = "";
            $_SESSION['reg_lname']   = "";
            $_SESSION['reg_email']   = "";
            $_SESSION['reg_email2']  = "";
        }
    }
?>