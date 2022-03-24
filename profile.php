<?php
session_start();

//there is no session or if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
}

include('connection.php');

$user_id = $_SESSION['user_id'];

// get username and email
$sql ="SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);


if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}
else{
    // error message
    echo "There was an error retrieving the username and email from the database";
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- styling css -->
    <!-- <link rel="stylesheet" href="styling.css"> -->
    <link rel="stylesheet" href="styling.css">


    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

    <title>Profile</title>

    <style>
        #container{
            margin-top: 100px;
            /* background-color: red; */
        }
        #notePad, #allNote, #done{
            display: none;
        }
        .buttons{
            margin-bottom: 20px;
        }
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #7065FF;
            /* color: #7065FF; */
            /* background-color: ; */
            padding: 10px;

        }
        tr{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav role="navigation" class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container-fluid">

            <!-- <div class="navbar-header"> -->
            <a class="navbar-brand" href="#">Online_Notes</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- </div> -->

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                    <li class="nav-item"><a class="nav-link" href="mainpageloggedin.php">My Notes</a></li>
                </ul>

                <!-- Login Button -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item navbar-right"><a class="nav-link" href="#" >Logged in as <b> <?php  echo $username; ?></b></a></li>
                    <li class="nav-item navbar-right"><a class="nav-link" href="index.php?logout=1" >Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Container -->
    <div class="container-fluid" id="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>General Account Settings:</h2>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-bordered">
                        <tr data-bs-target="#updateusername" data-bs-toggle="modal">
                            <td>Username</td>
                            <td> <?php echo $username; ?> </td>
                        </tr>
                        <tr data-bs-target="#updateemail" data-bs-toggle="modal">
                            <td>Email</td>
                            <td><?php $email; ?></td>
                        </tr>
                        <tr data-bs-target="#updatepassword" data-bs-toggle="modal">
                            <td>Password</td>
                            <td>hidden</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Update username -->
    <form action="" method="post" id="updateusernameform">
        <div class="modal fade" id="updateusername" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Username:</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- update username message from PHP file -->
                        <div id="updateusernamemessage">

                        </div>

                        <div class="mb-3">
                            <label for="username" >Username:</label>
                            <input class="form-control" type="text" name="username" id="username" maxlength="30" value="<?php echo $username; ?>">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <div> -->
                            <input class="btn blue" name="updateusername" type="submit" value="Submit">
                            <button type="button" class="btn btn-default " data-bs-dismiss="modal">Cancel</button>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Update email -->
    <form action="" method="post" id="updateemailform">
        <div class="modal fade" id="updateemail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Enter new email:</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- update email message from PHP file -->
                        <div id="updateemailmessage">

                        </div>

                        <div class="mb-3">
                            <label for="email" >Email:</label>
                            <input class="form-control" type="email" name="email" id="email" maxlength="50" value="<?php $email; ?>">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <div> -->
                            <input class="btn blue" name="updateusername" type="submit" value="Submit">
                            <button type="button" class="btn btn-default " data-bs-dismiss="modal">Cancel</button>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Update password -->
    <form action="" method="post" id="updatepasswordform">
        <div class="modal fade" id="updatepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Enter Current and New password:</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Update password message from PHP file -->
                        <div id="updatepasswordmessage">

                        </div>

                        <div class="mb-3">
                            <label for="currentpassword" class="visually-hidden">Your Current Password:</label>
                            <input class="form-control" type="password" name="currentpassword" id="currentpassword" maxlength="30" placeholder="Your Current Password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="visually-hidden">Choose a password:</label>
                            <input class="form-control" type="password" name="password" id="password" maxlength="30" placeholder="Choose a password">
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="visually-hidden">Confirm password:</label>
                            <input class="form-control" type="password" name="password2" id="password2" maxlength="30" placeholder="Confirm password">
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <!-- <div> -->
                            <input class="btn blue" name="updateusername" type="submit" value="Submit">
                            <button type="button" class="btn btn-default " data-bs-dismiss="modal">Cancel</button>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </form>




    

    <!-- Footer -->
    <div class="footer">
        <div class="container-fluid">
            <p>Development With Me. &copy;
                <?php $today = date("Y");
                echo $today;
                ?>
            </p>
        </div>
    </div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

    <!-- profile.js -->
    <script src="profile.js"></script>
</body>

</html>