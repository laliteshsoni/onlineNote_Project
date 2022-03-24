<!-- This file receives the user_id and key generated to create the new password -->
<!-- This file displays a form to input new password -->

<?php

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

    <title>Password Reset</title>
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
                <h1>Reset Password</h1>
                <div id="resultmessage"></div>

                <?php

                //If the user_id or key is missing
                if (!isset($_GET['user_id']) || !isset($_GET['key'])) {
                    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
                    exit;
                }
                // else
                //     Store them in two variables
                $user_id = $_GET['user_id'];
                $key = $_GET['key'];
                // define a time variable:now minus 24 hours
                $time = time() - 86400;
                //     Prepare variables for the query
                $user_id = mysqli_real_escape_string($link, $user_id);
                $key = mysqli_real_escape_string($link, $key);

                // run query: check combination of user_id & key exists and less than 24th old
                $sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
                //run query
                $result = mysqli_query($link, $sql);

                if (!$result) {
                    echo '<div class="alert alert-danger">Error running the query!</div>';
                    exit;
                }

                // if combination does not exist
                //show an error message
                $count = mysqli_num_rows($result);
                if ($count !== 1) {
                    echo '<div class="alert alert-danger">Please try again.</div>';
                    exit;
                }

                // print reset password form with hidden user_id and key fields
                echo "
                <form method=post id='passwordreset'>
                    <input type='hidden' name='key' value=$key>
                    <input type='hidden' name='user_id' value=$user_id>
                    <div class='mb-3'>
                        <label for='password'>Enter your new Password:</label>
                        <input class='form-control' type='password' name='password' id='password' placeholder='Enter Password'>
                    </div>
                    <div class='mb-3'>
                        <label for='password2'>Re-enter your new Password:</label>
                        <input class='form-control' type='password' name='password2' id='password2' placeholder='Re-enter Password'>
                    </div>
                    <input class='btn btn-success btn-lg' name='resetpassword' type='submit' value='Reset Password'>
                </form>
                ";

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

    <!-- // script for Ajax Call to storeresetpassword.php which processes form data -->
    <script>
        //Once the form is submitted
        $("#passwordreset").submit(function(event) {
            //prevent default php processing
            event.preventDefault();
            //collect user inputs
            var datatopost = $(this).serializeArray();
            // console.log(datatopost);

            //send them to signup.php using AJAX
            //AJAX Call successful: show error or success message
            //AJAX Call fails: show Ajax Call error
            $.ajax({
                url: "storeresetpassword.php",
                type: "POST",
                data: datatopost,
                success: function(data) {
                    $('#resultmessage').html(data);
                },
                error: function() {
                    $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                }
            });
        });
    </script>

</body>

</html>