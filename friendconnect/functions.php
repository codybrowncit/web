<?php
function do_query($query) {
    $host = 'mysql.cs.dixie.edu';
    $username = 'd0198042';
    $password = 'brown$';
    $database = $username;
    $conn = mysqli_connect($host, $username, $password, $database) or die("no connect");
    $results = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    return $results;
}
 function is_authentic($username, $password)
 {
     $row=get_user_info($username);
     if ($row['password']==$password && $row['username']==$username)
     {
         return True;
     }
     else
     {
         return False;
     }
 }
function get_role($username)
{
    $row=get_user_info($username);
    return $row['role_id'];
}
function get_user_info($username){
     $query ="select * from users where username='$username'";
     $row=  get_rows($query);
     return $row;
}
function get_rows($query){
     $results=do_query($query);
     $row = mysqli_fetch_assoc($results);
     return $row;
}
function show_table($results) {
    echo "<table border=0>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo"<tr>";
        foreach ($row as $k=> $val) {
            if($k=="uid"){
                echo"<td><input type='radio' value='$val' name='id'></td>";
            }
            else if($k=="postid"){
                echo"<td><input type='radio' value='$val' name='id'></td>";
            }else if($k=="profile"){
                echo"<td><img src='images/$row[profile]' alt='$row[profile]' width='100'></td>";
            }else if($k=="friend"){
                echo"<td><h3>$val</h3></td>";
            }else{
                echo "<td>$val</td> ";
            }  
         }
        echo "</tr>";
    }
    echo "</table>";
}
function upload($name){
    $tmp = $_FILES[$name]['tmp_name'];
    $FN = $_FILES[$name]['name'];
    $destination='./images/'.$FN;
    if(!is_dir('images')){
        mkdir('images');
        chmod('images', 0755);
    }
    if($FN != ""){
    move_uploaded_file($tmp, $destination);
    chmod($destination, 0644);
    }
    return $FN;       
}
?>

