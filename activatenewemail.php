<?php


// The user is re-directed to this file after clicking the  link received by email and aiming at proving they own the new email address.
// link contains three GET parameters: email, newemail and activation key
session_start();
include('connection.php');

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>New Email Activation</title>
    <style>
        h1 {
            color: #7065FF;
        }

        .contactForm {
            border: 1px solid #7c73f6;
            margin-top: 50px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1 offset-sm-1 col-sm-10 contactForm">
                <h1>Email Activation</h1>

                <?php

                // If email, newemail or activation key is missing show an error
                if (!isset($_GET['email']) || !isset($_GET['newemail']) || !isset($_GET['key'])) {
                    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
                    exit;
                }
                // else
                //     Store them in three variables
                $email = $_GET['email'];
                $newemail = $_GET['newemail'];
                $key = $_GET['key'];
                //     Prepare variables for the query
                $email = mysqli_real_escape_string($link, $email);
                $newemail = mysqli_real_escape_string($link, $newemail);
                $key = mysqli_real_escape_string($link, $key);

                //     Run query: update email
                $sql = "UPDATE users SET email='$newemail', activation2='0' WHERE (email='$email' AND activation2='$key') LIMIT 1";
                //run query
                $result = mysqli_query($link, $sql);
                //     If query is successful, show success message
                if (mysqli_affected_rows($link) == 1) {
                    // destroy session and remember me session
                    session_destroy();
                    setcookie("rememberme", "", time()-3600);
                    echo '<div class="alert alert-success">Your email has been updated.</div>';
                    echo '<a href="index.php" type="button" class="btn-lg btn-success">Log in</a>';
                } else {
                    //     else
                    //         Show error message
                    echo '<div class="alert alert-success">Your email could not be updated. Please try again later.</div>';
                }


                ?>
            </div>
        </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</body>

</html>