<?php
include_once "global.php";


////////////////////////////////////////////// ADD ITEM TO DATABASE ////////////////////////////////////////

//////////////////////////////////////////// ADD PAGE ///////////////////////////////////////////////
if ($_POST[process] == "AddPage") {
	$id = safe($_POST[id]);
	$Name = safe($_POST[Name]);
	$Title = safe($_POST[Title]);
	$Description = safe($_POST[Description]);
	$Content = safe($_POST[Content]);
	$ProgramsParent = safe($_POST[ProgramsParent]);
	$StudentsParent = safe($_POST[StudentsParent]);
	$FacultyParent = safe($_POST[FacultyParent]);
	$CampusParent = safe($_POST[CampusParent]);
	$EmployersParent = safe($_POST[EmployersParent]);
	$Category = safe($_POST[Category]);
	$PageAbove = safe($_POST[PageAbove]);
	$Featured = safe($_POST[Featured]);
	$Content = str_replace("../photos", "photos", $Content); 
	$Name = str_replace(" ", "_", $Name); 
	$Nested = safe($_POST[Nested]);
	
	if ($ProgramsParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $ProgramsParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Programs") { $PageAbove = $ProgramsParent; }
		}
	}
	if ($StudentsParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $StudentsParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Students") { $PageAbove = $StudentsParent; }
		}
	}
	if ($CampusParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $CampusParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Campus") { $PageAbove = $CampusParent; }
		}
	}
	if ($FacultyParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $FacultyParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Faculty") { $PageAbove = $FacultyParent; }
		}
	}
	if ($EmployersParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $EmployersParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Employers") { $PageAbove = $EmployersParent; }
		}
	}
	
	
	mysql_query( "LOCK TABLES Pages WRITE");
		mysql_query("INSERT INTO Pages (
		id,
		Name,
		Title,
		Description,
		Content,
		PageAbove,
		Category,
		Featured,
		Icon,
		Nested
		)
		values (
		'',
		'$Name',
		'$Title',
		'$Description',
		'$Content',
		'$PageAbove',
		'$Category',
		'$Featured',
		'$fn',
		'$Checked'
		)") or die ();
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
		 header("Location: main.php?func=ManagePages");
		 exit;
	}

//////////////////////////////////////////// ADD BANNER ///////////////////////////////////////////////
if ($_POST[process] == "AddBanner") {
	
	$Name = safe($_POST[Name]);
	$Content = safe($_POST[Content]);
	$Image = safe($_POST[Image]);
	$Active = safe($_POST[Active]);
	$BannerLink = safe($_POST[Link]);
	$BannerLink = str_replace("http://", "", $BannerLink);
	
	if ($Active == "on") {
		$Active = 1;
	} else if ($Active != "on") {
		$Active = 0;
	}
	
		
	if ($_FILES["Image"]["name"] != "") {
	// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["Image"]["name"]; // The file name
$fileName = str_replace("#", "", $fileName); 
$fileName = str_replace("$", "", $fileName); 
$fileName = str_replace("%", "", $fileName); 
$fileName = str_replace("^", "", $fileName); 
$fileName = str_replace("&", "and", $fileName); 
$fileName = str_replace("*", "", $fileName); 
$fileName = str_replace("?", "", $fileName); 
$fileName = str_replace(" ", "_", $fileName); 
$fileTmpLoc = $_FILES["Image"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["Image"]["type"]; // The type of file it is
$fileSize = $_FILES["Image"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["Image"]["error"]; // 0 for false... and 1 for true
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}
// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_Image() function
$moveResult = move_uploaded_file($fileTmpLoc, "../photos/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
}
//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
// ---------- Include Adams Universal Image Resizing Function --------


$target_file = "../photos/$fileName";
$resized_file = "../photos/fullsize/$fileName";
$wmax = 820;
$hmax = 110;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);


// ----------- End Adams Universal Image Resizing Function -----------
// Display things to the page so you can see what is happening for testing purposes
}
	mysql_query( "LOCK TABLES Banners WRITE");
		mysql_query("INSERT INTO Banners (
		id,
		Name,
		Content,
		BannerImage,
		Active,
		Date,
		Link
		)
		values (
		'',
		'$Name',
		'$Content',
		'$fileName',
		'$Active',
		'$date',
		'$BannerLink'
		)") or die (mysql_error());
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
		 header("Location: main.php?func=ManageBanners");
		 exit;
	}

//////////////////////////////////////////// ADD CLASS ///////////////////////////////////////////////
if ($_POST[process] == "AddClass") {
	
	$ClassName = safe($_POST[ClassName]);
	$FirstName = safe($_POST[FirstName]);
	$LastName = safe($_POST[LastName]);
	$StartDate = safe($_POST[Date]);
	$EndDate = safe($_POST[EndDate]);
	$StartTime = safe($_POST[StartTime]);
	$EndTime = safe($_POST[EndTime]);
	$Cost = safe($_POST[Cost]);
	$Campus = safe($_POST[Campus]);
	$DOW = safe($_POST[DOW]);
	$Description = safe($_POST[Description]);
	
	mysql_query( "LOCK TABLES Classes WRITE");
		mysql_query("INSERT INTO Classes (
		id,
		ClassName,
		FirstName,
		LastName,
		StartDate,
		EndDate,
		WeekDay,
		StartTime,
		EndTime,
		DSessionDOW,
		Cost,
		Campus,
		Description
		)
		values (
		'',
		'$ClassName',
		'$FirstName',
		'$LastName',
		'$StartDate',
		'$EndDate',
		'$DOW',
		'$StartTime',
		'$EndTime',
		'$DOW',
		'$Cost',
		'$Campus',
		'$Description'
		)") or die ();
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
		 header("Location: main.php?func=ManageClasses");
		 exit;
	}
//////////////////////////////////////////// ADD IMAGE ///////////////////////////////////////////////
if ($_POST[process] == "AddImage") {
	

// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["Image"]["name"]; // The file name
$fileName = str_replace("#", "", $fileName); 
$fileName = str_replace("$", "", $fileName); 
$fileName = str_replace("%", "", $fileName); 
$fileName = str_replace("^", "", $fileName); 
$fileName = str_replace("&", "and", $fileName); 
$fileName = str_replace("*", "", $fileName); 
$fileName = str_replace("?", "", $fileName); 
$fileName = str_replace(" ", "_", $fileName); 
$fileTmpLoc = $_FILES["Image"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["Image"]["type"]; // The type of file it is
$fileSize = $_FILES["Image"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["Image"]["error"]; // 0 for false... and 1 for true
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}
// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_Image() function
$moveResult = move_uploaded_file($fileTmpLoc, "../photos/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
}
//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
// ---------- Include Adams Universal Image Resizing Function --------

$target_file = "../photos/$fileName";
$resized_file = "../photos/thumbs/$fileName";
$wmax = 90;
$hmax = 70;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);

$target_file = "../photos/$fileName";
$resized_file = "../photos/icons/$fileName";
$wmax = 40;
$hmax = 33;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);

$target_file = "../photos/$fileName";
$resized_file = "../photos/fullsize/$fileName";
$wmax = 500;
$hmax = 400;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);

// ----------- End Adams Universal Image Resizing Function -----------
// Display things to the page so you can see what is happening for testing purposes


	mysql_query( "LOCK TABLES Images WRITE");
		mysql_query("INSERT INTO Images (
		id,
		Name
		)
		values (
		'',
		'$fileName'
		)") or die ();
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
		 header("Location: main.php?func=ManageImages");
		 exit;
	}
//////////////////////////////////////////// ADD USER ///////////////////////////////////////////////
if ($_POST[process] == "AddUser") {
	$firstname = safe($_POST[firstname]);
	$lastname = safe($_POST[lastname]);
	$login = safe($_POST[Username]);
	$passwd = safe($_POST[Password]);
	$passwd = md5($passwd);
	
	
	
	mysql_query( "LOCK TABLES members WRITE");
		mysql_query("INSERT INTO members (
		member_id,
		firstname,
		lastname,
		login,
		passwd
		)
		values (
		'',
		'$firstname',
		'$lastname',
		'$login',
		'$passwd'
		)") or die ();
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
		 header("Location: main.php?func=ManageUsers");
		 exit;
	}
//////////////////////////////////////////// ADD EVENT ///////////////////////////////////////////////
if ($_POST[process] == "AddEvent") {
	$Name = safe($_POST[Name]);
	$Description = safe($_POST[Description]);
	$StartDate = safe($_POST[StartDate]);
	
	mysql_query( "LOCK TABLES der WRITE");
		mysql_query("INSERT INTO der (
		id,
		Name,
		ShortDescription,
		StartDate,
		Approved
		)
		values (
		'',
		'$Name',
		'$Description',
		'$StartDate',
		'1'
		)") or die ();
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
	 header("Location: main.php?func=ManageCalendar");
	 exit;
	}

//////////////////////////////////////////// ADD DOCUMENT ///////////////////////////////////////////////
if ($_POST[process] == "AddDoc") {
	$id = safe($_POST[id]);
	$Name = safe($_POST[Name]);
	$ProgramsParent = safe($_POST[ProgramsParent]);
	$StudentsParent = safe($_POST[StudentsParent]);
	$FacultyParent = safe($_POST[FacultyParent]);
	$CampusParent = safe($_POST[CampusParent]);
	$EmployersParent = safe($_POST[EmployersParent]);
	
	
	if ($ProgramsParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $ProgramsParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Programs") { $PageAbove = $ProgramsParent; }
		}
	}
	if ($StudentsParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $StudentsParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Students") { $PageAbove = $StudentsParent; }
		}
	}
	if ($CampusParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $CampusParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Campus") { $PageAbove = $CampusParent; }
		}
	}
	if ($FacultyParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $FacultyParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Faculty") { $PageAbove = $FacultyParent; }
		}
	}
	if ($EmployersParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $EmployersParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == "Employers") { $PageAbove = $EmployersParent; }
		}
	}
	
	if ($_FILES['LibraryDoc']['name'] != "")
	{
	$file = $_FILES['LibraryDoc'];
	$allowedExtensions = array("txt", "doc", "docx", "DOC", "pdf", "PDF", "DOCX", "xls", "XLS");
	
	
	if($file['error'] == UPLOAD_ERR_OK) {
	if(isAllowedExtension($file['name'])) {
	  
	 $fn = $_FILES['LibraryDoc']['name'];
	 $fn = str_replace("#", "", $fn); 
	 $fn = str_replace("$", "", $fn); 
	 $fn = str_replace("%", "", $fn); 
	 $fn = str_replace("^", "", $fn); 
	 $fn = str_replace("&", "and", $fn); 
	 $fn = str_replace("*", "", $fn); 
	 $fn = str_replace("?", "", $fn); 
	 $fn = str_replace(" ", "", $fn); 
	 $src = '../Docs/'.$fn;
		
	if (!@move_uploaded_file ($_FILES['LibraryDoc']['tmp_name'], $src)) die ('Can not upload file...');
	  
	  } else {
	    print ("$fn could not be uploaded");
	    exit;
	  }
	} else die("Cannot upload");
}
	
	mysql_query( "LOCK TABLES Docs WRITE");
		mysql_query("INSERT INTO Docs (
		id,
		Name,
		PageAbove,
		DocName
		)
		values (
		'',
		'$Name',
		'$PageAbove',
		'$fn'
		)") or die (mysql_error());
		 mysql_query( "UNLOCK TABLES" ); # Unlock the tables
		 header("Location: main.php?func=ManageDocs");
		 exit;
}


//////////////////////////////////////////////////// EDIT ITEM IN DATABASE ////////////////////////////////////////////

//////////////////////////////////////////// EDIT ENROLL NOW BANER ///////////////////////////////////////////////
if ($_POST[process] == "EditEnrollBanner") {
	
	$OldPic = safe($_POST[OldPic]);

// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["Image"]["name"]; // The file name
$fileName = str_replace("#", "", $fileName); 
$fileName = str_replace("$", "", $fileName); 
$fileName = str_replace("%", "", $fileName); 
$fileName = str_replace("^", "", $fileName); 
$fileName = str_replace("&", "and", $fileName); 
$fileName = str_replace("*", "", $fileName); 
$fileName = str_replace("?", "", $fileName); 
$fileName = str_replace(" ", "_", $fileName); 
$fileTmpLoc = $_FILES["Image"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["Image"]["type"]; // The type of file it is
$fileSize = $_FILES["Image"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["Image"]["error"]; // 0 for false... and 1 for true
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}
// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_Image() function
$moveResult = move_uploaded_file($fileTmpLoc, "../photos/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
}
//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
// ---------- Include Adams Universal Image Resizing Function --------

$target_file = "../photos/$fileName";
$resized_file = "../photos/thumbs/$fileName";
$wmax = 90;
$hmax = 70;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);

$target_file = "../photos/$fileName";
$resized_file = "../photos/icons/$fileName";
$wmax = 40;
$hmax = 33;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);

$target_file = "../photos/$fileName";
$resized_file = "../photos/fullsize/$fileName";
$wmax = 500;
$hmax = 400;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);

// ----------- End Adams Universal Image Resizing Function -----------
// Display things to the page so you can see what is happening for testing purposes


	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE Contacts SET 
		EnrollNow = '$fileName'
		WHERE id = '1'") or die(mysql_error());
		
		$sql = "SELECT EnrollNow FROM Contacts Where id = '1'";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$EnrollNow = $agentarray['EnrollNow'];
		}
		if ($EnrollNow == "") {
			$EnrollNow = "$OldPic";
			mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
			mysql_select_db($database);  
			mysql_query("UPDATE Contacts SET 
			EnrollNow ='$EnrollNow'
			WHERE id = '1'") or die(mysql_error());
			}
			header("Location: main.php?func=Admin");
		 exit;
	}

/////////////////////////////////////////////////// EDIT CONTACT INFO ////////////////////////////////////////////////
if ($_POST[process] == "EditContacts") {
	$Name = safe($_POST[Name]);
	$Address = safe($_POST[Address]);
	$City = safe($_POST[City]);
	$State = safe($_POST[State]);
	$Zip = safe($_POST[Zip]);
	$Email = safe($_POST[Email]);
	$Phone = safe($_POST[Phone]);
	$Fax = safe($_POST[Fax]);
	$Facebook = safe($_POST[Facebook]);
	$Twitter = safe($_POST[Twitter]);
	$LinkedIn = safe($_POST[LinkedIn]);
	$OldPic = safe($_POST[OldPic]);
	$Image = safe($_POST[Image]);
	
		
	if ($_FILES["Image"]["name"] != "") {
	// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["Image"]["name"]; // The file name
$fileName = str_replace("#", "", $fileName); 
$fileName = str_replace("$", "", $fileName); 
$fileName = str_replace("%", "", $fileName); 
$fileName = str_replace("^", "", $fileName); 
$fileName = str_replace("&", "and", $fileName); 
$fileName = str_replace("*", "", $fileName); 
$fileName = str_replace("?", "", $fileName); 
$fileName = str_replace(" ", "_", $fileName); 
$fileTmpLoc = $_FILES["Image"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["Image"]["type"]; // The type of file it is
$fileSize = $_FILES["Image"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["Image"]["error"]; // 0 for false... and 1 for true
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}
// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_Image() function
$moveResult = move_uploaded_file($fileTmpLoc, "../photos/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
}
//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
// ---------- Include Adams Universal Image Resizing Function --------


$target_file = "../photos/$fileName";
$resized_file = "../photos/fullsize/$fileName";
$wmax = 820;
$hmax = 110;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);


// ----------- End Adams Universal Image Resizing Function -----------
// Display things to the page so you can see what is happening for testing purposes
}
		
		mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE Contacts SET 
		Name ='$Name',
		Address ='$Address',
		City = '$City',
		State = '$State',
		Zip = '$Zip',
		Email = '$Email',
		Phone = '$Phone',
		Fax = '$Fax',
		Facebook = '$Facebook',
		Twitter = '$Twitter',
		LinkedIn = '$LinkedIn',
		EnrollNow = '$fileName'
		WHERE id = '1'") or die(mysql_error());
		
		$sql = "SELECT EnrollNow FROM Contacts Where id = '1'";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$EnrollNow = $agentarray['EnrollNow'];
		}
		if ($EnrollNow == "") {
			$EnrollNow = "$OldPic";
			mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
			mysql_select_db($database);  
			mysql_query("UPDATE Contacts SET 
			EnrollNow ='$EnrollNow'
			WHERE id = '1'") or die(mysql_error());
			}
	
		header("Location: main.php?func=Admin");
		 exit;

}
/////////////////////////////////////////////////// EDIT SITE INFO ////////////////////////////////////////////////
if ($_POST[process] == "EditSiteInfo") {
	$Name = safe($_POST[Name]);
	$GoogleAna = safe($_POST[GoogleAna]);
	
		
		mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE SiteInfo SET 
		Name ='$Name',
		GoogleAna ='$GoogleAna'
		WHERE id = '1'") or die(mysql_error());
	
		header("Location: main.php?func=Admin");
		 exit;

}
/////////////////////////////////////////////////// APPROVE EVENT ////////////////////////////////////////////////
if ($_GET[process] == "approveEvent") {
	$id = $_GET[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
	mysql_select_db($database);  
	mysql_query("UPDATE der SET 
	Approved ='1'
	WHERE id = '$id'") or die(mysql_error());

	header("Location: main.php?func=ManageCalendar");
	 exit;

}
/////////////////////////////////////////////////// DISAPPROVE EVENT ////////////////////////////////////////////////
if ($_GET[process] == "disapproveEvent") {
	$id = $_GET[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	
	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
	mysql_select_db($database);  
	mysql_query("UPDATE der SET 
	Approved ='0'
	WHERE id = '$id'") or die(mysql_error());

	header("Location: main.php?func=ManageCalendar");
	 exit;

}
/////////////////////////////////////////////////// EDIT USER ////////////////////////////////////////////////
if ($_POST[process] == "EditUser") {
	$firstname = safe($_POST[firstname]);
	$lastname = safe($_POST[lastname]);
	$login = safe($_POST[UserName]);
	$passwd = safe($_POST[Password]);
	$passwd = md5($passwd);
	
	
	if (!is_numeric ($_POST[id])) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$id = safe ($_POST['id']);
	if ($passwd != "") {
		mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE members SET 
		firstname ='$firstname',
		lastname = '$lastname',
		passwd ='$passwd',
		login ='$login'
		WHERE member_id = '$id'") or die(mysql_error());
		header("Location: main.php?func=ManageUsers");
		exit;
	} else if ($passwd == "") {
	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE members SET 
		firstname ='$firstname',
		lastname = '$lastname',
		login ='$login'
		WHERE member_id = '$id'") or die(mysql_error());
		header("Location: main.php?func=ManageUsers");
		exit;
	}
}
//////////////////////////////////////////// EDIT BANNER ///////////////////////////////////////////////
if ($_POST[process] == "EditBanner") {
	$id = safe($_POST[id]);
	$Name = safe($_POST[Name]);
	$Content = safe($_POST[Content]);
	$Image = safe($_POST[Image]);
	$Active = safe($_POST[Active]);
	$Link = safe($_POST[Link]);
	$OldBanner = safe($_POST[OldBanner]);
	$Link = str_replace("http://", "", $Link);
	
	if ($Active == "on") {
		$Active = 1;
	} else if ($Active != "on") {
		$Active = 0;
	}
	
	if ($_FILES["Image"]["name"] != "") {
	// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["Image"]["name"]; // The file name
$fileName = str_replace("#", "", $fileName); 
$fileName = str_replace("$", "", $fileName); 
$fileName = str_replace("%", "", $fileName); 
$fileName = str_replace("^", "", $fileName); 
$fileName = str_replace("&", "and", $fileName); 
$fileName = str_replace("*", "", $fileName); 
$fileName = str_replace("?", "", $fileName); 
$fileName = str_replace(" ", "_", $fileName); 
$fileTmpLoc = $_FILES["Image"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["Image"]["type"]; // The type of file it is
$fileSize = $_FILES["Image"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["Image"]["error"]; // 0 for false... and 1 for true
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}
// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_Image() function
$moveResult = move_uploaded_file($fileTmpLoc, "../photos/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
}
//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
// ---------- Include Adams Universal Image Resizing Function --------


$target_file = "../photos/$fileName";
$resized_file = "../photos/fullsize/$fileName";
$wmax = 820;
$hmax = 110;
resizeImage($target_file, $resized_file, $wmax, $hmax, $fileExt);


// ----------- End Adams Universal Image Resizing Function -----------
// Display things to the page so you can see what is happening for testing purposes
}
	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
	mysql_select_db($database);  
	mysql_query("UPDATE Banners SET 
	Name ='$Name',
	Content ='$Content',
	BannerImage ='$fileName',
	Active = '$Active',
	Link = '$Link'
	WHERE id = '$id'") or die(mysql_error());
	header("Location: main.php?func=ManageBanners");
	exit;
}
//////////////////////////////////////////// EDIT PAGE ///////////////////////////////////////////////
if ($_POST[process] == "EditPage") {
	$id = safe($_POST[id]);
	$Name = safe($_POST[Name]);
	$Title = safe($_POST[Title]);
	$Description = safe($_POST[Description]);
	$Content = safe($_POST[Content]);
	$ProgramsParent = safe($_POST[ProgramsParent]);
	$StudentsParent = safe($_POST[StudentsParent]);
	$FacultyParent = safe($_POST[FacultyParent]);
	$CampusParent = safe($_POST[CampusParent]);
	$EmployersParent = safe($_POST[EmployersParent]);
	$Category = safe($_POST[Category]);
	$Locked = safe($_POST[Locked]);
	$PageAbove = safe($_POST[PageAbove]);
	$Nested = safe($_POST[Nested]);
	$Featured = safe($_POST[Featured]);
	$Content = str_replace("../photos", "photos", $Content); 
	$Name = str_replace(" ", "_", $Name); 
	
	if ($ProgramsParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $ProgramsParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == $Category) { $PageAbove = $ProgramsParent; }
		}
	}
	if ($StudentsParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $StudentsParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == $Category) { $PageAbove = $StudentsParent; }
			
		}
	}
	if ($CampusParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $CampusParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == $Category) { $PageAbove = $CampusParent; }
		}
	}
	if ($FacultyParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $FacultyParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == $Category) { $PageAbove = $FacultyParent; }
			
		}
	}
	if ($EmployersParent != "") {
		$sql = "SELECT Category FROM Pages Where id = $EmployersParent";
		$result = mysql_query($sql, $conn);
		while ($agentarray = mysql_fetch_array($result)) {
			$Cat = stripslashes($agentarray['Category']);
			if ($Cat == $Category) { $PageAbove = $EmployersParent; }
			
		}
	}

	if ($Locked == "0") {
		mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE Pages SET 
		Name ='$Name',
		Title ='$Title',
		Description ='$Description',
		Content = '$Content',
		PageAbove = '$PageAbove',
		Category = '$Category',
		Featured = '$Featured',
		Icon = '$fileName',
		Nested = '$Nested'
		WHERE id = '$id'") or die(mysql_error());
		header("Location: main.php?func=ManagePages");
		exit;
	} else if ($Locked == "1") {
		mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
		mysql_select_db($database);  
		mysql_query("UPDATE Pages SET 
		Name ='$Name',
		Title ='$Title',
		Description ='$Description',
		Content = '$Content'
		WHERE id = '$id'") or die(mysql_error());
		header("Location: main.php?func=ManagePages");
		exit;
	}
}
//////////////////////////////////////////// EDIT CLASS ///////////////////////////////////////////////
if ($_POST[process] == "EditClass") {
	$id = safe($_POST[id]);
	$ClassName = safe($_POST[ClassName]);
	$FirstName = safe($_POST[FirstName]);
	$LastName = safe($_POST[LastName]);
	$StartDate = safe($_POST[Date]);
	$EndDate = safe($_POST[EndDate]);
	$StartTime = safe($_POST[StartTime]);
	$EndTime = safe($_POST[EndTime]);
	$Cost = safe($_POST[Cost]);
	$Campus = safe($_POST[Campus]);
	$DOW = safe($_POST[DOW]);
	$Description = safe($_POST[Description]);
	
	
	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
	mysql_select_db($database);  
	mysql_query("UPDATE Classes SET 
	ClassName = '$ClassName',
	FirstName = '$FirstName',
	LastName = '$LastName',
	StartDate = '$StartDate',
	EndDate = '$EndDate',
	StartTime = '$StartTime',
	EndTime = '$EndTime',
	Cost = '$Cost',
	Campus = '$Campus',
	WeekDay = '$DOW'
	WHERE id = '$id'") or die(mysql_error());
	
	mysql_connect($server, $DBusername, $DBpassword) or die ("$DatabaseError");
	mysql_select_db($database);  
	mysql_query("UPDATE ClassDescription SET 
	Description = '$Description',
	Name = '$ClassName'
	WHERE Name = '$ClassName'") or die(mysql_error());
	
	header("Location: main.php?func=ManageClasses");
	exit;
}

/////////////////////////////////////////////////// DELETE ////////////////////////////////////////////////
/////////////////////////////////////////////////// DELETE PAGE ////////////////////////////////////////////////
if ($_POST[process] == "DelPage") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$mod = "DELETE FROM Pages WHERE id = $id";
	mysql_query($mod) or die(mysql_error());
	header("Location: main.php?func=ManagePages");
	exit;
}
/////////////////////////////////////////////////// DELETE BANNER ////////////////////////////////////////////////
if ($_POST[process] == "DelBanner") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$sql = "SELECT BannerImage FROM Banners Where id = $id";
	$result = mysql_query($sql, $conn);
	while ($agentarray = mysql_fetch_array($result)) {
		$Pic = $agentarray['BannerImage'];
	}
	
	$mod = "DELETE FROM Banners WHERE id = $id";
	mysql_query($mod) or die(mysql_error());
	if ($Pic != "") {
		unlink ("../photos/$Pic");
		unlink ("../photos/fullsize/$Pic");
	}
	header("Location: main.php?func=ManageBanners");
	exit;
}
/////////////////////////////////////////////////// DELETE CALENDAR ITEM ////////////////////////////////////////////////
if ($_POST[process] == "DelCalendar") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$mod = "DELETE FROM der WHERE id = $id";
	mysql_query($mod) or die(mysql_error());
	header("Location: main.php?func=ManageCalendar");
	exit;
}
/////////////////////////////////////////////////// DELETE CLASS ////////////////////////////////////////////////
if ($_POST[process] == "DelClass") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	
	$mod = "DELETE FROM Classes WHERE id = '$id'";
	mysql_query($mod) or die(mysql_error());
	
	header("Location: main.php?func=ManageClasses");
	exit;
}
/////////////////////////////////////////////////// DELETE IMAGE ////////////////////////////////////////////////
if ($_POST[process] == "DelImage") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$sql = "SELECT Name FROM Images Where id = $id";
	$result = mysql_query($sql, $conn);
	while ($agentarray = mysql_fetch_array($result)) {
		$Pic = $agentarray['Name'];
	}	
	$mod = "DELETE FROM Images WHERE id = $id";
	mysql_query($mod) or die(mysql_error());
	unlink ("../photos/$Pic");
	unlink ("../photos/fullsize/$Pic");
	unlink ("../photos/thumbs/$Pic");
	header("Location: main.php?func=ManageImages");
	exit;
}

/////////////////////////////////////////////////// DELETE DOCUMENT ////////////////////////////////////////////////
if ($_POST[process] == "DelDoc") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$sql = "SELECT Name, DocName FROM Docs Where id = $id";
	$result = mysql_query($sql, $conn);
	while ($agentarray = mysql_fetch_array($result)) {
		$DocName = $agentarray['DocName'];
	}	
	$mod = "DELETE FROM Docs WHERE id = $id";
	mysql_query($mod) or die(mysql_error());
	unlink ("../Docs/$DocName");
	header("Location: main.php?func=ManageDocs");
	exit;
}
/////////////////////////////////////////////////// DELETE USER ////////////////////////////////////////////////
if ($_POST[process] == "DelUser") {
	$id = $_POST[id];
	if (!is_numeric ($id)) {
		header("Location: main.php?func=Error&error=badid");
		exit;
	}
	$mod = "DELETE FROM Admin WHERE id = $id";
	mysql_query($mod) or die(mysql_error());
	header("Location: main.php?func=ManageUsers");
	exit;
}
?>