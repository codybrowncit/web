<!doctype html>
<html>
<head>
<meta name="keywords" content="printing company, printing company gauteng, sign printing company, sign printing company gauteng" />
<meta name="description" content="Signmedia specializes in printing graphics, vehicle decals, stickers, silk-screening, road signs, safety signs, cut out alumnium / Perspex lettering, light boxes and banners - printing company, printing company gauteng, sign printing company, sign printing company gauteng" />
<meta charset="UTF-8">
<title>Contact Signmedia Signage Solutions</title>
<?php include 'header.php'; ?>
    <div id="top">
        <p> Thank you for you interest! 
		Please fill out the form below and click the Submit button. 
		We will contact you for more information!
        </p>
    </div>
    <div id="left">
        <form action="contactus.php" method="post">
            Date: <input type="text" id="datepicker" name="date" /><br />
            First Name: <input type="text" name="firstname" /><br />
            Last Name: <input type="text" name="lastname" /><br />
            <label for="email">Email Address:<input type="text" id="email" title="Example: someone@something.co.za" name="email" /><br />
            <label for="phone">Phone Number:</label><input type="text"  id="phone" title= "Example: 031 700 8101" name="phone" /><br />
            
            Memo:<br />
            <textarea cols="30" rows="10" name="message"></textarea><br />
            <input type="submit"name="submit" value="Submit">
        </form>
    <?php 
if(isset($_POST['submit']))
{	
	$errors = array();
	if( !preg_match("/^[A-Z0-9]+[A-Z0-9\.\_\-]*@([A-Z0-9]+[A-Z0-9\.\_\-]*\.[A-Z]{2,4})$/i", $_POST['email'],
$matches) )
{
    $errors[] = 'Please enter a valid Email.';
}else{
    $invalid_domains = array("spamavert.com", "fake.com");
    if( !checkdnsrr(strtolower($matches[1]), 'MX') OR in_array(strtolower($matches[1]), $invalid_domains) )
    {
        $errors[] = 'Please enter a REAL Email.';
    }
}
if( !preg_match("/^1{0,1}[\(\s\.\-]{0,2}\d{3}[\)\s\.\-]{0,2}\d{3}[\.\-]{0,1}\d{4}$/",$_POST['phone']) )
{
    $errors[] = 'Please enter a valid Phone #.';
}
if( (sizeof($errors) > 0) OR (!isset($_POST['submit'])) )
{		
	{
		echo '<div style="border:#aa0000 1px solid;background:#ffdddd;color:#aa0000;padding:15px;">';
		
		if(sizeof($errors) == 1)
		{
			echo '<h3 style="margin:0px 0px 5px;">An Error was found</h3>';
		}
		else
		{
			echo '<h3 style="margin:0px 0px 5px;">Multiple Errors were found</h3>';
		}

		foreach($errors as $key=>$error){	
			echo (1+(int)$key).'. '.$error.'<br />';
		}
		
		echo '</div>';
	}		
}
else
{ 
$date = $_POST['date'];
$name = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$message = stripslashes($_POST['message']);
$phone = $_POST['phone'];
$formcontent="From: $name $lname \n Phone Number: $phone \n Date Sent: $date /n Message: $message";
$recipient = "codyliabrown@gmail.com";
$subject = "Contact Form";
$mailheader = "From: $email";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank You! We will contact you soon.";
}
}
?>

    </div>
    <div id="right">
        <p>Marion Yarnell<br />
        Phone Number: 031 700 8101<br />
        Fax Number: 031 700 8102<br />
        Email Address: marion@sign-media.co.za
        </p>
    </div>
    <div id="rightimage">	
        <img src="images/signwriting6.jpg" alt="Production Logix sign" width="400px" height="250px">
    </div>
</div>
<?php include 'footer.php'; ?>    