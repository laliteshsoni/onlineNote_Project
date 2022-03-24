<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
include('rememberme.php');

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
    <link rel="stylesheet" href="styling.css">


    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

    <title>Online Notes</title>
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
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                </ul>

                <!-- Login Button -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item navbar-right"><a class="nav-link" href="#loginModal" data-bs-toggle="modal">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Jumbotron with Sign up Button -->
    <!-- <div class="container-fluid" id="myContainer"> -->
    <!-- jumbotron -->
    <div class="container" id="myContainer">
        <h1>Online Notes App</h1>
        <p>Your Notes with you wherever you go.</p>
        <p>Easy to use, protects all your notes!</p>
        <button type="button" class="btn btn-lg blue signup" data-bs-target="#signupModal" data-bs-toggle="modal">Sign up-It's Free</button>
    </div>
    <!-- </div> -->


    <!-- Login form -->
    <form action="" method="post" id="loginform">
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Login:</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Login message from PHP file -->
                        <div id="loginmessage">

                        </div>

                        <div class="mb-3">
                            <label for="loginemail" class="visually-hidden">Email:</label>
                            <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="loginpassword" class="visually-hidden">Password:</label>
                            <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
                        </div>
                        <div class="checkbox">
                            <label for="">
                                <input type="checkbox" name="rememberme" id="rememberme">
                                Remember me
                            </label>
                            <a class="float-end" href="" style="cursor: pointer;" data-bs-dismiss="modal" data-bs-target="#forgotpasswordModal" data-bs-toggle="modal">
                                Forget Password?
                            </a>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal" data-bs-target="#signupModal" data-bs-toggle="modal">Register</button>
                        <div>
                            <input class="btn blue" name="login" type="submit" value="Login">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>




    <!-- Sign up form -->
    <form action="" method="post" id="signupform">
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Sign up now and start using our Online Notes App!</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Sign up message from PHP file -->
                        <div id="signupmessage">

                        </div>

                        <div class="mb-3">
                            <label for="username" class="visually-hidden">Username:</label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="visually-hidden">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="visually-hidden">Choose a password:</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="visually-hidden">Confirm password</label>
                            <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input class="btn blue" name="signup" type="submit" value="Sign up">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Forget password form -->
    <form action="" method="post" id="forgotpasswordform">
        <div class="modal fade" id="forgotpasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Forgot Password? Enter your email address:</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Forgot password message from PHP file -->
                        <div id="forgotpasswordmessage">

                        </div>

                        <div class="mb-3">
                            <label for="forgotemail" class="visually-hidden">Email:</label>
                            <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal" data-bs-target="#signupModal" data-bs-toggle="modal">Register</button>
                        <div>
                            <input class="btn blue" name="forgotpassword" type="submit" value="Submit">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                        </div>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- index.js -->
    <script src="index.js"></script>
</body>

</html>