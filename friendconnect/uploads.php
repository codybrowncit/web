<?php
session_start();
include_once 'functions.php';
$row=  get_user_info($_SESSION[user]);
if (isset($_POST['update'])){
    print_r($_FILES);
    print_r($_POST);
    $profile= upload('profile');
    $cover=  upload('cover');
    if ($profile==""){
        $profile=$row[profile];
    }
    if($cover==""){
        $cover=$row[picture];
    }
    $query="UPDATE users SET username='$_POST[newuser]', lname='$_POST[lname]', "
            . "fname='$_POST[fname]', password='$_POST[newpass]', "
            . "address='$_POST[address]', city='$_POST[city]', state='$_POST[state]',"
            . " zip='$_POST[zip]', `phone_#`='$_POST[phone]', `role_id`='$_SESSION[role]', "
            . "profile='$profile', picture='$cover' WHERE uid='$_SESSION[userid]'";
    $results=  do_query($query);
    header("Location:./profile.php");
}
?>
