<?php session_start();
 
	$randomnr = rand(1000, 9999);
	$_SESSION["rand_captcha"] =$randomnr;
	$im = imagecreatetruecolor(100, 38);
 
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 150, 150, 150);
	$black = imagecolorallocate($im, 0, 0, 0);

	imagecolortransparent($im, $black);
 
	imagefilledrectangle($im, 0, 0, 200, 35, $black);

	//path to font - this is just an example you can use any font you like:
	
	$font = dirName(__FILE__).'/fonts/Gardens.ttf';

	imagettftext($im, 25, 4, 22, 30, $grey, $font, $randomnr);
 
	imagettftext($im, 25, 4, 15, 32, $white, $font, $randomnr);
 	
	imagegif($im);
	imagedestroy($im);


?>