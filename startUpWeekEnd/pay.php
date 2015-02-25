<?php
include_once 'header.php';
?>
    <div id='left'>
        <img src='images/couple.jpg' alt='wedding photo' width='300'></img>
    </div>

    <div id="right">
 <form  action='process.php' method='POST'>
        <p>
            <label>Name:</label><br /><input name='name' type='text' class='inputfield' maxlength='60' size='75'/><br />
            <br /><label>Email:</label><br /><input name='newuser' type='text' class='inputfield' maxlength='60' size='75'/><br />
            <br /><label>Custom Message:<br /><textarea  name='message' rows='5' cols='60' id='msgtxt' name='msgtxt'></textarea><br />
            <br /><label>Credit Card #:</label><br /><input name='credit' type='text' class='inputfield' maxlength='60' size='75'/><br />
            <br /><label>Exp. Date:</label><br /><input name='exp' type='text' class='inputfield' maxlength='4'/><br />
            <br /><label>Security Code:</label><br /><input name='exp' type='text' class='inputfield' maxlength='4'/><br />
            <table>
                <tr>
                    <td width='100'>
                        <label>Gift Amount:</label>
                    </td>
                    <td>
                        $50.00
                    </td>
                </tr>
                <tr>
                    <td width='100'>
                        <label>Service Fee:</label>
                    </td>
                    <td>
                        $1.00
                    </td>
                </tr>
                 </tr>
                <tr>
                    <td width='100'>
                        <label>Total:</label>
                    </td>
                    <td>
                        $51.00
                    </td>
                </tr>
            </table>

            <br /><input class="button" type="submit" name="submit" value="Submit"/>
        </p>
 </form> 
    </div>
</div>
    
</body>