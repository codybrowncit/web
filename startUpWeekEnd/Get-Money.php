<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>New Fund</title>
<link href="mainstyle.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="container">
  <div class="content">
    <?php include "header.php"; ?>
    
    <div class="clearfloat"></div>
<div id="mainTitle">Create a Fund for People to Give To</div>
    <div class="mainBody">
    		<form action="assets/process.php" method="post" enctype="multipart/form-data" name="signup">
           	  <table class="formTable" border="0" cellpadding="4">
  <tr>
    <td width="22%">First Name</td>
    <td width="78%"><input name="FirstName" type="text" id="FirstName" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input name="LastName" type="text" id="LastName" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>Email </td>
    <td><input name="Email" type="text" id="Email" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>Email Address</td>
    <td><input name="EmailAddress" type="text" id="EmailAddress" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>Event Name</td>
    <td><input name="EventName" type="text" id="EventName" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>Event Date</td>
    <td><input name="EventDate" type="text" id="EventDate" size="40" maxlength="75"></td>
  </tr>
   <tr>
    <td>Event Message</td>
    <td><textarea name="Message" id="Message" cols="38" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>Video Link</td>
    <td><input name="VideoLink" type="text" id="VideoLink" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="Submit" id="Submit" value="Submit"></td>
  </tr>
</table>
            
            </form>
    </div>
    <div class="footer">
    	Terms and Conditions<br>
		Weddings<br>
		Graduations<br>
		Funerals<br>
		Births<br>

    </div>
<!-- end .content --></div>
  <!-- end .container --></div>
</body>
</html>