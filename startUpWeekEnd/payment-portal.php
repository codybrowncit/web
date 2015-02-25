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
<div id="mainTitle">Give a Gift to John and Mary</div>
    <div class="mainBody">
	  <div class="leftColumn">
	  <img src="images/John-Mary.jpg" width="200" height="200" alt="John and Mary"> </div>
      <div class="rightColumn">
      		<span class="eventName">John Black and Mary Day</span><br>
            Getting Married May 14, 2014<br>Donation Amount: $25<br>
            <form action="assets/process.php" method="post" enctype="multipart/form-data" name="signup">
           	  <table class="payTable" border="0" cellpadding="4">
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
    <td>Credit Card Number</td>
    <td><input name="EventName" type="text" id="EventName" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td colspan="2">Expiration Date &nbsp;&nbsp;<select name="expmonth">
    									<option value="01">01</option>
                                        <option value="01">02</option>
                                        <option value="01">03</option>
                                        <option value="01">04</option>
                                        <option value="01">05</option>
                                        <option value="01">06</option>
                                        <option value="01">07</option>
                                        <option value="01">08</option>
                                        <option value="01">09</option>
                                        <option value="01">10</option>
                                        <option value="01">11</option>
                                        <option value="01">12</option>
                                        </select>
                                        <select name="expyear">
    									<option value="01">2014</option>
                                        <option value="01">2015</option>
                                        <option value="01">2016</option>
                                        
                                        </select>
                    &nbsp;Security Code: <input name="secCode" type="text" id="secCode" size="3" maxlength="4">
    
    </td>
  </tr> 
  <tr>
    <td>Address</td>
    <td><input name="EventDate" type="text" id="EventDate" size="40" maxlength="75"></td>
  </tr>
  <tr>
    <td>City</td>
    <td><input name="EventDate" type="text" id="EventDate" size="40" maxlength="75"></td>
  </tr> 
  <tr>
    <td>State</td>
    <td><select Name=State>
				<option value="NONE" selected="selected">Select a State</option> 
					<option value="AL">Alabama</option> 
					<option value="AK">Alaska</option> 
					<option value="AZ">Arizona</option> 
					<option value="AR">Arkansas</option> 
					<option value="CA">California</option> 
					<option value="CO">Colorado</option> 
					<option value="CT">Connecticut</option> 
					<option value="DE">Delaware</option> 
					<option value="DC">District Of Columbia</option> 
					<option value="FL">Florida</option> 
					<option value="GA">Georgia</option> 
					<option value="HI">Hawaii</option> 
					<option value="ID">Idaho</option> 
					<option value="IL">Illinois</option> 
					<option value="IN">Indiana</option> 
					<option value="IA">Iowa</option> 
					<option value="KS">Kansas</option> 
					<option value="KY">Kentucky</option> 
					<option value="LA">Louisiana</option> 
					<option value="ME">Maine</option> 
					<option value="MD">Maryland</option> 
					<option value="MA">Massachusetts</option> 
					<option value="MI">Michigan</option> 
					<option value="MN">Minnesota</option> 
					<option value="MS">Mississippi</option> 
					<option value="MO">Missouri</option> 
					<option value="MT">Montana</option> 
					<option value="NE">Nebraska</option> 
					<option value="NV">Nevada</option> 
					<option value="NH">New Hampshire</option> 
					<option value="NJ">New Jersey</option> 
					<option value="NM">New Mexico</option> 
					<option value="NY">New York</option> 
					<option value="NC">North Carolina</option> 
					<option value="ND">North Dakota</option> 
					<option value="OH">Ohio</option> 
					<option value="OK">Oklahoma</option> 
					<option value="OR">Oregon</option> 
					<option value="PA">Pennsylvania</option> 
					<option value="RI">Rhode Island</option> 
					<option value="SC">South Carolina</option> 
					<option value="SD">South Dakota</option> 
					<option value="TN">Tennessee</option> 
					<option value="TX">Texas</option> 
					<option value="UT">Utah</option> 
					<option value="VT">Vermont</option> 
					<option value="VA">Virginia</option> 
					<option value="WA">Washington</option> 
					<option value="WV">West Virginia</option> 
					<option value="WI">Wisconsin</option> 
					<option value="WY">Wyoming</option>
		
	</select></td>
  </tr>
  <tr>
    <td>Message to John and Mary</td>
    <td><textarea name="message" cols="38" rows="4"></textarea>
    </td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="Submit" id="Submit" value="Submit"></td>
  </tr>
</table>
            
            </form>
      </div>
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