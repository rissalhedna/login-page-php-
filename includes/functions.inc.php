<?php

function emptyInput($uid,$pwd,$pwdrepeat,$email){
    $result;
    if(empty($uid) || empty($pwd) ||empty($pwdrepeat) ||empty($email)){
        $result = false;
    }else{
        $result = true;
    }

    return $result;
}
function emptyInputLogin($uid,$pwd){
    $result;
    if(empty($uid) || empty($pwd)){
        $result = false;
    }else{
        $result = true;
    }

    return $result;
}

function invalidUid($uid){
    $result;

    if(!preg_match("/^[a-zA-Z0-9]*$/",$uid)){
        $result= false;
    }else{
        $result = true;
    }
    return $result;
}

function invalidEmail($email){
    $result;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result= false;
    }else{
        $result = true; 
    }
    return $result;
}

function pwdMatch($pwd,$pwdrepeat){
    $result;

    if($pwd != $pwdrepeat){
        $result= false;
    }else{
        $result = true; 
    }
    return $result;
}

function uidExists($conn, $uid, $email){


    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?";
    $stmt = mysqli_stmt_init($conn);

    //we bind the sql statement to the database first
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../index.php?error=stmtFailed");
        exit();
    }
    //s : string
    // 2 s means 2 strings
    mysqli_stmt_bind_param($stmt,"ss",$uid, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){

        //if user exists inside database we store
        //their data in the row variable in order
        //to use later in LOGIN form
        return $row;

    }else{

        $result = false;
        return $result;

    }

    mysqli_stmt_close($stmt);

}

function createUser($conn,$email,$uid,$pwd){


    $sql = "INSERT INTO users (userEmail, userUid, userPwd) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    //we bind the sql statement to the database first
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

    //s : string
    // 3 s means 3 strings
    mysqli_stmt_bind_param($stmt,"sss",$email,$uid,$hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none");
    exit();

}

function loginUser($conn,$uid,$pwd){
    $uidExists = uidExists($conn, $uid, $uid);

    if($uidExists === false){
        header("location: ../index.php?error=wrongLogin");
        exit();
    }

    //grab the data column from the database:
    $pwdHashed = $uidExists["userPwd"];

    $checkPwd = password_verify($pwd,$pwdHashed);

    if($checkPwd===false){
        header("location: ../index.php?error=wrongLogin");
        exit();
    }else if($checkPwd===true){

        //user logged in so we keep track of session that's open
        
        session_start();
        $_SESSION["userid"] = $uidExists["userId"];
        $_SESSION["useruid"] = $uidExists["userUid"];
        
        header("location: ../index.php?error=none");
        exit();
    }
}
