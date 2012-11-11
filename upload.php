<?php
error_reporting(0);

include_once('includes/config.php');
include_once('includes/functions.php');

if ($_GET['act'] == 'thumb') {
	$arr = array(
		'uploaddir' => $imgthumb,
		'tempdir' => $imgtemp,
		'height' => $_POST['height'],
		'width' => $_POST['width'],
		'x' => $_POST['x'],
		'y' => $_POST['y'],
		'img_src' => $_POST['img_src'],
		'thumb' => true,
		'fileError' => $fileError,
		'sizeError' => $sizeError,
	);
	resizeThumb($arr);
	exit;
} elseif ($_GET['act'] == 'upload') {
	
	$big_arr = array(
		'uploaddir' => $imgbig,
		'tempdir' => $imgtemp,
		'height' => $_POST['height'],
		'width' => $_POST['width'],
		'x' => 0,
		'y' => 0,
		'fileError' => $fileError,
		'sizeError' => $sizeError,
	);

	resizeImg($big_arr);
	
} else {
	//nothing to do here
}
?>