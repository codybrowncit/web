<?php include("header.php"); ?>

<body>
        <div id= "wrapper">
           <?php include ("logo.php"); ?>
           <?php include("menu.php"); ?>
		
        	 <div id="content">
           		Feel free to conctact us for any additional information.  Please leave the following information.<br/><br/>    
                
             <div class="floatright" >
             	CPR.<br/>
                615 N., 3050 E. #A9<br/>
                St. George, Utah.84790<br/>
                435-535-1719<br/>
               
                <a href="mailto:crittercpr@cpadrecycling.com">crittercpr@cpadrecycling.com</a> <br/>
                <a href="mailto:jasonbcpr@cpadrecycling.com">jasonbcpr@cpadrecycling.com</a><br/>
                <a href="mailto:shalacocpr@cpadrecycling.com">shalacocpr@cpadrecycling.com</a><br/>
             </div>   

                     
                <form method="post" action="mailer.php"  >
                
                	<div class="myrows">
                        <label class="labelCol">Name:</label>
                         <input type="text" name="name"/>
                     </div>
                    
                    <div class="myrows"> 
                        <label class="labelCol">E-mail:</label>
                         <input type="text" name="email" />
                     </div>
                     
                    <div class="myrows"> 
                        <label class="labelCol">Phone:</label>
                        <input type="text" name="phone" maxlength ="12"/>
                    </div>
                    
                    <div class="myrows"> 
                        <label class="labelCol">Subject:</label>
                            <select name="subject" size="1">
                                <option selected="selected" value ="Select reason for contact">Select reason for contact</option>
                                <option  value="Price Quota">Price Quota</option>
                                <option value="Portfolio Request">Service Request</option>
                                <option value="More Information Needed">More Information Needed</option>
                                <option value="Other">Questions or Concerns</option>
                            </select>
                     </div>       
                        

    
    				<div class="myrows"> 
                        <label class="labelCol">Message:</label>
                        <textarea name="message" cols="20" rows="2"></textarea>
                    </div>
                    
                    <div class="myrows"> 
                    	<input type="submit" class="mySubmit" value="Send"/>
                        <input type="reset" class="mySubmit" value="Reset"/>
                    </div>
                    
                  
                </form>
                
           </div>
            
           


<?php include("footer.php"); ?>