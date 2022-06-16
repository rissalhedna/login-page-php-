<?php

//the file to which we send the data when we sign up the user
if(isset($_POST["submit"])){
    
    
    $email = $_POST["email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInput($email,$uid,$pwd,$pwdrepeat) !== true){
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    if(invalidUid($uid) !== true){
        header("location: ../index.php?error=invalidUid");
        exit();
    }

    if(invalidEmail($email) !== true){
        header("location: ../index.php?error=invalidEmail");
        exit();
    }

    if(pwdMatch($pwd,$pwdrepeat) !== true){
        header("location: ../index.php?error=PasswordsDontMatch");
        exit();
    }

    // need a connection to the database to check whether the user already exists
    
    if(uidExists($conn, $uid, $email) !== false){
        header("location: ../index.php?error=uidExists");
        exit();
    }   

    createUser($conn,$email,$uid,$pwd);

}else{
    header("location: ../index.php");
    exit();
}