<?php
include_once 'header_auth.php';

echo"<form action='friends.php' method='POST'>";
    $query="select uid,fname, lname, profile from users where fname!='$_SESSION[user]'";
    $results=  do_query($query);
    show_table($results);
    echo"<input class='button' id='btnPost' type='submit' name='friend' value='Friend' />";
    echo"<input class='button' id='btnPost' type='submit' name='unfriend' value='Unfriend' />";
echo"</form>";
//if friend button is clicked creates friend
if(isset($_POST[friend])){
    $query="select fname from users where uid='$_POST[id]'";
    $row=  get_rows($query);
    $rows=  get_user_info($_SESSION[user]);
    $query="insert into friends (name, friend) value('$rows[fname]', '$row[fname]')";
    $results=  do_query($query);
    $query="insert into friends (name, friend) value('$row[fname]', '$rows[fname]')";
    $results=  do_query($query);
    echo "you are now friends";
}
//if unfriend button is clicked deletes friend
if(isset($_POST[unfriend])){
    $query="select fname from users where uid='$_POST[id]'";
    $row=  get_rows($query);
    $rows=  get_user_info($_SESSION[user]);
    $query="delete from friends where name='$rows[fname]' and friend='$row[fname]'";
    $results=  do_query($query);
    $query="delete from friends where name='$row[fname]' and friend='$rows[fname]'";
    $results=  do_query($query);
    echo"you are no longer friends";
}

include_once 'footer.php';

?>

