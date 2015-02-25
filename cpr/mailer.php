<?php

// define variables as submitted user input

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

//prevent url injection

if (eregi('http:', $message))
{
die ("Not allowed.");
}

/* make sure the email has at least a correct format. */

if(!$email == "" && (!strstr($email,"@") || !strstr($email,".")))
{
echo "Invalid mail address, try again.";
$badinput = "Message not delivered.";
echo $badinput;
die ("Try again. ");
}

// check for missing fields

if(empty($name) || empty($email) || empty ($phone) || empty($subject) || empty($message))
{
echo "Woops, you missed a required field!";
die ("Go back!!");
}

$today = date("l, F j, Y, g:i a") ;





/* strips any slashes from the message
and prevents escaping the code and
injecting commands through the form */

$message = stripcslashes($message);

$message = "$today [EST]
From: $name
Email: $email
Subject: $subject
Phone: $phone
Message: $message
";

// who the message will come from
$from = $email;

//echo $subject;
//echo $message;


// who the mail will be delivered to, and message contents
mail("crittercpr@cpadrecycling.com", $subject, $message);
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mailer.php</title>
</head>

<body>
    <p>
        <!-- confirm message delivery, and thank user by name for sending feedback -->
        Date: <?php echo $today ?>
        <br />
        Thank you for contacting us, <?php echo $name ?>, we'll be in touch soon.
    </p>
</body>
</html>