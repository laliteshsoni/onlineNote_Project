<!-- // This file receives the user_id and generated key to reset password, password1 and password2
//This file then resets password for user_id if all checks are correct -->

<?php

session_start();
include('connection.php');


//If the user_id or key is missing
if (!isset($_POST['user_id']) || !isset($_POST['key'])) {
    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
    exit;
}
// else
// Store them in two variables
$user_id = $_POST['user_id'];
$key = $_POST['key'];
// define a time variable:now minus 24 hours
$time = time() - 86400;
// Prepare variables for the query
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


// Define error message
$missingPassword = '<p><strong>Please enter a password!</strong></p>';
$InvalidPassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Password don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password!</strong></p>';

// Get user inputs: password1 and password2
// Get passwords
if(empty($_POST["password"])){
    $errors .= $missingPassword;
}
else if(!(strlen($_POST["password"]) > 6 and preg_match('/[A-Z]/' , $_POST["password"]) and preg_match('/[0-9]/' , $_POST["password"]) )){
    $errors .= $InvalidPassword;
}
else{
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    // second password is missing
    if(empty($_POST["password2"])){
        $errors .= $missingPassword2;
    }
    else{
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}

// If there are any errors
if($errors){
    $resultMessage = '<div class="alert alert-danger">'. $errors .'</div>';
    echo $resultMessage;
    exit;
}

// If there are no errors
    // prepare variables for the query
$password = mysqli_real_escape_string($link, $password);
$password = hash('sha256', $password);
$user_id = mysqli_real_escape_string($link, $user_id);

// Run Query: Update users password in the users tables
$sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
// Run query
$result = mysqli_query($link, $sql);

// check if query is successful
if(!$result){
    echo '<div class="alert alert-danger">There was a problem storing the new password in the database!</div>';
    // echo '<div class="alert alert-danger">' . mysqli_error($link) .'</div>';
    exit;
}


// set the key status to "used" in the forgotpassword table to prevent the key from being used twice
$sql = "UPDATE forgotpassword SET status='used' WHERE rkey='$key' AND user_id='$user_id'";
// Run Query
$result = mysqli_query($link, $sql);

// check if query is successful
if(!$result){
    echo '<div class="alert alert-danger">Error running the query</div>';
}
else{
    // Success message
    echo '<div class="alert alert-success">Your password has been update successfully!<a href="index.php">Login</a></div>';
}






// If query successfull












// If user_id or activation key is missing
// Print error message
// else
// Store them in two variables
// Define a time variable: now minus 24 hours
// Prepare variables for the query
// Run query: check combination of user_id & key exists and less than 24th old
//run query



// if combination does not exist
// Print error message
// else
// Define error message
// Get user inputs: password1 and password2
// If there are any errors
// Print error message
// else
    // print success message



?>