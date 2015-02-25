<?php
session_start();
$date=  date('Y-m-d');
include_once 'functions.php';
//creates posts 
if (isset($_POST[post])&& $_POST[comment]!=''){
    $query="insert into posts (post, uid, date) values('$_POST[comment]', '$_SESSION[uid]', '$date')";
    $results=  do_query($query);  
    header("Location:./profile.php");
}
//deletes posts for a certian user
if (isset($_POST[delete])){
    $query="select uid from posts where postid='$_POST[id]'";
    $row=  get_rows($query);
    if ($row[uid]==$_SESSION[uid]){
    $query="delete from posts where postid='$_POST[id]'";
    $results=  do_query($query);
    
    }
    header("Location:./profile.php");
}
?>
