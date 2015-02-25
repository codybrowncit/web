<?php
session_start();
$user=$_POST[username];
$pass=$_POST[password];
include_once 'functions.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (is_authentic($user, $pass)&& $user!=""){
        $row = get_user_info($user);
        if($row[role_id] == 1)
        {
            $_SESSION[role]='1';
        }
        else{
           $_SESSION[role]='2';
        }
        $row=  get_user_info($user);
        $_SESSION[user]=$user;
        $_SESSION[uid]=$row[uid];
        $_SESSION[fname]=$row[fname];
        $_SESSION[loggedin]=TRUE;
        echo 1;
    }else{
        echo 0;
    }
}

?>

