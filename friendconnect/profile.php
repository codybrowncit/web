<?php
include_once 'header_auth.php';
                    $row=get_user_info($_SESSION[user]);
                    $phone=$row['phone_#'];
$_SESSION[userid]=$row[uid];
                    echo"<div id='banner' style='background: url(images/$row[picture]) no-repeat;'>    
                        </div>
                        <div id='two_column'>
                            <div class='two_columns_left'>
                                <img src='images/$row[profile]' alt='$row[profile]' width='200'>
                                <h3>$row[fname] $row[lname]</h3>
                                <h2>About Me:</h2>
                                Address: $row[address]<br />
                                City: $row[city]<br />
                                State: $row[state]<br />
                                Zip Code: $row[zip]<br />
                                Phone #: $phone<br />
                                <button id='opener'>Edit Profile</button><br />
                             
                                
                            </div>
                            <div class='two_colums_right'>
                                <h2>Friends:</h2>";
                                
                                $query="select friend from friends where name='$_SESSION[user]'";
                                $results=  do_query($query);
                                
                                show_table($results);
                                
                                
                                echo"<div id='postTable'>";
                                    $query="select friend from friends where name='$_SESSION[user]'";
                                    $rows=  get_rows($query);
                                    
                                   print_r($rows);
                                    echo"<form id='posts' action='post.php' method='POST'>";
                                    $query= "select u.fname, p.post, p.date, p.postid from users as u join posts as p on u.uid=p.uid where u.uid='$_SESSION[uid]' or u.fname='$rows[friend]' order by p.date"; 
                                    $results=  do_query($query);
                                    show_table($results);
                                    echo"<input class='button' id='btnUpdate' type='submit' name='delete' value='delete' />
                                        ";
                                                                                                          
                               echo"</div>
                            </div>
                        </div>
                        <div id='one_column'>
                            
                                <textarea  name='comment' rows='2' cols='80'id='msgtxt' name='msgtxt'>
                                </textarea>
                                <input class='button' id='btnPost' type='submit' name='post' value='Post' />                               
                            </form>
                        </div>";
                           
                        
                        
                        echo"<div id='dialog' title='Edit Profile'>
                                    <form id='update' action='uploads.php' method='POST' enctype='multipart/form-data'>
                                        <label><strong>Username</strong></label><br /><input name='newuser' type='text' value='$row[username]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>Password</strong></label><br /><input name='newpass' type='password' value='$row[password]'class='inputfield' maxlength='30'/><br />
                                        <label><strong>First Name</strong></label><br /><input name='fname' type='text' value='$row[fname]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>Last Name</strong></label><br /><input name='lname' type='text' value='$row[lname]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>Address</strong></label><br /><input name='address' type='text' value='$row[address]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>City</strong></label><br /><input name='city' type='text' value='$row[city]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>State</strong></label><br /><input name='state' type='text' value='$row[state]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>Zip Code</strong></label><br /><input name='zip' type='text' value='$row[zip]' class='inputfield' maxlength='30'/><br />
                                        <label><strong>Phone #</strong></label><br /><input name='phone' type='text' value='$phone' class='inputfield' maxlength='30'/><br />
                                        <label><strong>Profile Picture</strong></label><input type='file' name='profile'class='inputfield' /><br />
                                        <label><strong>Cover Picture</strong></label><input type='file' name='cover'class='inputfield' /><br />
                                        <input class='button' id='btnUpdate' type='submit' name='update' value='Update' />
                                    </form>";
                    
                                echo"</div>";
include_once 'footer.php';
?>