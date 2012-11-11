<?php
// factor for the real size of the uploaded image
$sizefactor=3;

// size of the big, preview and thumb container
$bigWidthPrev=400;
$bigHeightPrev=200;

// canvas size for the uploaded image
$canvasWidth=$bigWidthPrev*$sizefactor;
$canvasHeight=$bigHeightPrev*$sizefactor;

// file type error
$fileError='Filetype not allowed. Please upload again. Only GIF, JPG and PNG files are allowed.';
$sizeError='File is too big. Please upload again. Maximum filesize is 1.3MB.';

// image upload folders
$imgthumb='uploads/';
$imgtemp='uploads/temp/';
$imgbig='uploads/big/';
?>
