<?php
	// database values
	$server = "localhost";
	$DBusername = "jzhdesin_swatc";
	$DBpassword = "DMB13293";
	$database = "jzhdesin_SWATC";	
	 
	 
	$conn = mysql_connect("$server", $DBusername, $DBpassword);
	mysql_select_db($database,$conn);
	$SiteURL = "http://www.swatc.edu";
	
	$SiteName = "SWATC";
	$LogoPath = "http://www.silverlizarddesign.com.com/swatc/Admin/images/logo.png";
	
	
function safe($value) { 
   return mysql_real_escape_string($value); 
} 

function mark_select($dbvar, $value) {
	if ($dbvar == $value) { print ("selected=selected");
}
}

function ShortenText($text) {              
	$chars = 100;          
	$text = $text." ";         
	$text = substr($text,0,$chars);         
	$text = substr($text,0,strrpos($text,' '));         
	$text = $text."...";          
	return $text;      }

function ShortenSpecialText($text) {              
	$chars = 355;          
	$text = $text." ";         
	$text = substr($text,0,$chars);         
	$text = substr($text,0,strrpos($text,' '));         
	$text = $text."...";          
	return $text;      }

function make_thumb ($img_src, $img_th)
	{
	 // some configuration, please match to your server settings
	 $gd_version = 2;
	 $thumb_on = 'x';
	 $thumb_size = 95;
	 $quality = 90;
	
	 $img_size = GetImageSize ($img_src);
	 $img_in = ImageCreateFromJPEG ($img_src);
	
	 if ($thumb_on == 'y')
	 {
	 $img_x = ($thumb_size/$img_size[1]) * $img_size[0];
	 $img_y = $thumb_size;
	 }
	 else
	 {
	 $img_y = ($thumb_size/$img_size[0]) * $img_size[1];
	 $img_x = $thumb_size;
	 }
	
	 if ($gd_version == '1')
	 {
	 $img_out = ImageCreate($img_x, $img_y);
	 ImageCopyResized ($img_out, $img_in, 0, 0, 0, 0, $img_x, $img_y, $img_size[0], $img_size[1]);
	 }
	 elseif ($gd_version == '2')
	 {
	 $img_out = ImageCreateTrueColor($img_x, $img_y);
	 ImageCopyResampled ($img_out, $img_in, 0, 0, 0, 0, $img_x, $img_y, $img_size[0], $img_size[1]);
	 }
	
	 ImageJPEG ($img_out, $img_th, $quality);
	 ImageDestroy ($img_out);
	 ImageDestroy ($img_in);
	}	
	
function make_smlthumb ($img_src, $img_th)
	{
	 // some configuration, please match to your server settings
	 $gd_version = 2;
	 $thumb_on = 'x';
	 $thumb_size = 40;
	 $quality = 70;
	
	 $img_size = GetImageSize ($img_src);
	 $img_in = ImageCreateFromJPEG ($img_src);
	
	 if ($thumb_on == 'y')
	 {
	 $img_x = ($thumb_size/$img_size[1]) * $img_size[0];
	 $img_y = $thumb_size;
	 }
	 else
	 {
	 $img_y = ($thumb_size/$img_size[0]) * $img_size[1];
	 $img_x = $thumb_size;
	 }
	
	 if ($gd_version == '1')
	 {
	 $img_out = ImageCreate($img_x, $img_y);
	 ImageCopyResized ($img_out, $img_in, 0, 0, 0, 0, $img_x, $img_y, $img_size[0], $img_size[1]);
	 }
	 elseif ($gd_version == '2')
	 {
	 $img_out = ImageCreateTrueColor($img_x, $img_y);
	 ImageCopyResampled ($img_out, $img_in, 0, 0, 0, 0, $img_x, $img_y, $img_size[0], $img_size[1]);
	 }
	
	 ImageJPEG ($img_out, $img_th, $quality);
	 ImageDestroy ($img_out);
	 ImageDestroy ($img_in);
	}	
	
function make_Med_Thumb ($img_src, $img_th)
	{
	 // some configuration, please match to your server settings
	 $gd_version = 2;
	 $thumb_on = 'x';
	 $thumb_size = 540;
	 $quality = 80;
	
	 $img_size = GetImageSize ($img_src);
	 $img_in = ImageCreateFromJPEG ($img_src);
	
	 if ($thumb_on == 'y')
	 {
	 $img_x = ($thumb_size/$img_size[1]) * $img_size[0];
	 $img_y = $thumb_size;
	 }
	 else
	 {
	 $img_y = ($thumb_size/$img_size[0]) * $img_size[1];
	 $img_x = $thumb_size;
	 }
	
	 if ($gd_version == '1')
	 {
	 $img_out = ImageCreate($img_x, $img_y);
	 ImageCopyResized ($img_out, $img_in, 0, 0, 0, 0, $img_x, $img_y, $img_size[0], $img_size[1]);
	 }
	 elseif ($gd_version == '2')
	 {
	 $img_out = ImageCreateTrueColor($img_x, $img_y);
	 ImageCopyResampled ($img_out, $img_in, 0, 0, 0, 0, $img_x, $img_y, $img_size[0], $img_size[1]);
	 }
	
	 ImageJPEG ($img_out, $img_th, $quality);
	 ImageDestroy ($img_out);
	 ImageDestroy ($img_in);
	}

	function isAllowedExtension($fileName) {
		global $allowedExtensions;
		return in_array(end(explode(".", $fileName)), $allowedExtensions);
	}






// Adam Khoury PHP Image Function Library 1.0
// Function for resizing any jpg, gif, or png image files
function resizeImage($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);
}

	
?>