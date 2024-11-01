<?php 

if(empty($_POST["username"])){
    die("Username is required!");
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("A valid email is required!");
}

if(strlen($_POST["password"] < 8)){
    die("Password must be atleast 8 characters long!");
}

if(! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must contain atleast 1 letter!");
}

if(! preg_match("/[0-9]/", $_POST["password"])){
    die("Password must contain atleast 1 number!");
}

if($_POST["password"] !== $_POST["confirm_password"]){
    die("Passwords must match!");
}

$hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);



print_r($_POST);