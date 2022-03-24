<?php
session_start();

//there is no session or if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
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
    <link rel="stylesheet" href="styling.css">


    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

    <title>My Notes</title>

    <style>
        #container {
            margin-top: 120px;
            /* background-color: green; */
        }

        #notePad, #allNote, #done, .delete {
            display: none;
        }

        .buttons {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #7065FF;
            /* color: #7065FF; */
            /* background-color: green; */
            padding: 10px;
        }

        .noteheader {
            border: 1px solid #7065FF;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            /* background: linear-gradient(#F0EFFF, #7065FF); */
            background-color: #F0EFFF;
        }

        .text {
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .timetext {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
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
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">My Notes</a></li>
                </ul>

                <!-- Login Button -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item navbar-right"><a class="nav-link" href="#">Logged in as <b> <?php  echo $_SESSION['username'] ?></b></a></li>
                    <li class="nav-item navbar-right"><a class="nav-link" href="index.php?logout=1">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Container -->
    <div class="container-fluid" id="container">
        <!-- Alert Message -->
        <div id="alert" class="alert alert-danger collapse">
            <a class="btn-close float-end" data-bs-dismiss="alert">
                <!-- &times; -->
            </a>
            <p id="alertContent"></p>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="buttons justify">
                    <button id="addNote" type="button" class="btn btn-lg blue ">Add Note</button>
                    <button id="allNote" type="button" class="btn btn-lg blue ">All Notes</button>
                    <button id="edit" type="button" class="btn btn-lg blue float-end">Edit</button>
                    <button id="done" type="button" class="btn btn-lg btn-success float-end">Done</button>
                </div>

                <div id="notePad">
                    <textarea name="" id="" rows="10"></textarea>
                </div>

                <div id="notes" class="notes">
                    <!-- Ajax call to a php file -->
                </div>

            </div>
        </div>
    </div>




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

    <!-- mynotes.js -->
    <script src="mynotes.js"></script>

</body>

</html>