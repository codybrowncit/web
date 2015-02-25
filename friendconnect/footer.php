                <div id="footer">
                    <?php
                    if ($_SESSION[loggedin]){
                        echo"<a href='./logout.php'>Logout</a><br />";//deletes session
                    }
                    ?>
                    Copyright © <a href="https://www.facebook.com/codyliabrown">Cody Brown</a> <!--link to facebook page-->
                </div>
            </div>
        </div>
    </body>
</html>