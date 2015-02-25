<!--This header page is used on pages that require authentication-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>FriendConnect.com</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//d79i1fxsrar4t.cloudfront.net/jquery.liveaddress/2.4/jquery.liveaddress.min.js"></script>
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/dot-luv/jquery-ui.css"></link>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
            $(function()
            {
                $( "#dialog" ).dialog(
                {
                    autoOpen: false,
                    show: 
                    {
                        effect: "blind",
                        duration: 1000
                    },
                    hide: 
                    {
                        effect: "explode",
                        duration: 1000
                    }
                });
                $( "#opener" ).click(function() 
                {
                    $( "#dialog" ).dialog( "open" );
                });
            });
        </script>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="container">
            <div id="leftcolumn">
            <div id="sitetitle">
                <div class="title">
                    Friend <span>Connect</span>
                </div>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="profile.php">Main Page</a></li>
                    <li><a href="friends.php">Find Friends</a></li>
                </ul>
            </div>
            <?php
            session_start();
            include_once 'functions.php';
            if (!isset($_SESSION['loggedin']))
            {
                $_SESSION['loggedin']=FALSE;
            }
            if(!isset($_SESSION['user']))
            {
                echo"<div id='search'>
                    <div id='responce'></div>
                    <h2>Login</h2>
                    <form id='login' action='process_jquery.php' method='POST'>
                        <label><strong>Username</strong></label><input name='username' type='text' class='inputfield' maxlength='30'/>
                        <label><strong>Password</strong></label><input name='password' type='password' class='inputfield' maxlength='30'/>
                        <input class='button' id='btnLogin' type='submit' name='login' value='Login' />
                    </form>";
            }else{
                $row=get_user_info($_SESSION[user]);
                echo"<div id='search'>
                <h2> $row[fname] $row[lname] is Logged in.</h2>";
            }
            if(!isset($_SESSION['user']))
            {
                header("Location:./index.php");
            }
            ?>
                </div>
            </div>
            <div id="rightcolumn">