                <?php
                include_once 'header.php';  
                echo"<div id='banner'style='background: url(images/bannerBG.jpg) no-repeat;'>
                        <h1>Welcome to Friend Connect</h1>
                        Click Here to <button id='opener'>Sign Up!</button><br />";//create new user button
                //creates new user account when save from dropdown box is clicked   
                if (isset($_POST[newuser])){
                   if ($_POST[newuser]!="" && $_POST[newpass]!="" ){
                            $query="insert into users (username, password, fname, lname, address, city, state, zip, `phone_#`, role_id) "
                                    . "values('$_POST[newuser]', '$_POST[newpass]', '$_POST[fname]', '$_POST[lname]', '$_POST[address]', "
                                    . "'$_POST[city]','$_POST[state]', '$_POST[zip]', '$_POST[phone]', 2)";
                            $results=  do_query($query);
                            echo 'Your account has been saved!';
                    }
                }
                        echo"</div>
                      
                        <div id='two_column'>
                            <div class='two_columns_left'>
                                <h1>Hello World, Let's be friends!</h1>
                            </div>
                            <div class='two_columns_right'>
                                <h1> Like, Share, Explore!</h1>
                            </div>
                        </div>";
                

                ?>
<!--                Create New Account Dropdown Box -->
                <div id="dialog" title="Create New Account">
                    <form  action='index.php' method='POST'>
                        <label><strong>Username</strong></label><br /><input name='newuser' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>Password</strong></label><br /><input name='newpass' type='password' class='inputfield' maxlength='30'/><br />
                        <label><strong>First Name</strong></label><br /><input name='fname' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>Last Name</strong></label><br /><input name='lname' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>Address</strong></label><br /><input name='address' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>City</strong></label><br /><input name='city' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>State</strong></label><br /><input name='state' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>Zip Code</strong></label><br /><input name='zip' type='text' class='inputfield' maxlength='30'/><br />
                        <label><strong>Phone #</strong></label><br /><input name='phone' type='text' class='inputfield' maxlength='30'/><br />
                        <input class='button' id='btnSave' type='submit' name='save' value='Save' />
                    </form>
                </div>
                <?php
                include_once 'footer.php';
                ?>