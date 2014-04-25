<?php
// factor for the real size of the uploaded image
$sizefactor = 3;

// size of the big, preview and thumb container
$bigWidthPrev = 400;
$bigHeightPrev = 400;

// canvas size for the uploaded image
$canvasWidth = $bigWidthPrev * $sizefactor;
$canvasHeight = $bigHeightPrev * $sizefactor;

// file type error
$fileError = 'Filetype not allowed. Please upload again. Only GIF, JPG and PNG files are allowed.';
$sizeError = 'File is too big. Please upload again. Maximum filesize is 1.3MB.';

// image upload folders
$imgthumb = 'uploads/ready/'; // folder for the uploads after cropping
$imgtemp = 'uploads/temp/'; // temp-folder before cropping
$imgbig = 'uploads/big/'; // folder with big uploaded images

// max file-size for upload in bytes, default: 3mb
$maxuploadfilesize = 3200000;

// background color of the canvas as rgb, default:white
$canvasbg = array(
	'r' => 255,
	'g' => 255,
	'b' => 255
);
?>
