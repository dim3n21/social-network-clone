<?php 
    $con = mysqli_connect("localhost", "root", "", "social");

    if(mysqli_connect_errno()) {
        echo "failed to connect: " . mysqli_connect_errno();
    }

    $query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Dmitry')");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello World!
</body>
</html>