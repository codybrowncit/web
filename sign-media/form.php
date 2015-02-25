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
        $errors[] = 'Please enter a REAL email.';
    }
}
if( !preg_match("/^1{0,1}[\(\s\.\-]{0,2}\d{3}[\)\s\.\-]{0,2}\d{3}[\.\-]{0,1}\d{4}$/",$_POST['phone']) )
{
    $errors[] = 'Please enter a valid phone number.';
}
if( (sizeof($errors) > 0) OR (!isset($_POST['submit'])) )
{		
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
            echo 'Date: <input type="text" id="datepicker" name="date"size="35" value="'.stripslashes($_POST['date']).'" /><br />';
            echo 'First Name: <input type="text" name="firstname"size="35" value="'.stripslashes($_POST['firstname']).'" /><br />';
            echo 'Last Name: <input type="text" name="lastname"size="35" value="'.stripslashes($_POST['lastname']).'" /><br />';
            echo 'Email Address:  <input type="text" name="email"size="35" value="'.stripslashes($_POST['email']).'" /><br />';
            echo 'Phone Number: <input type="text" name="phone" size="35" value="'.stripslashes($_POST['phone']).'"/><br />';
            echo 'Memo:<br />';
            echo '<textarea cols="30" rows="10" name="message">'.stripslashes($_POST['message']).'</textarea><br />';
            echo '<input type="submit" name="submit" value="Submit">';
        echo '</form>';
if(sizeof($errors) > 0)
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
echo "Thank You! We will contact you soon." . " -" . "<a href='index.php' style='text-decoration:none;color:#ff0099;'> Return to Home</a>";
}
}
?>
