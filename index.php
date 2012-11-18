<?php
require_once 'includes/mobileDetect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
include_once('includes/config.php');
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>jQuery Image Upload and Crop - Demo</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		<script type="text/javascript">
			var useMobile=<?php if($deviceType=='tablet'||$deviceType=='phone') { echo 'true';} else {echo 'false';}?>;
		</script>
	</head>

	<body>
		
		<!-- title begin -->
		<div class="title">
			<h1>Ajax Image-Upload and Crop - Demo</h1>
		</div>
		<!-- title end -->

		<!-- content wrapper begin -->
		<div class="wrapper">

			<div class="uploader">

				<!-- first step upload image begin -->
				<div id="big_uploader">
					<form name="upload_big" id="upload_big" class="uploaderForm" method="post" enctype="multipart/form-data" action="upload.php?act=upload" target="upload_target">
						<h3><strong>1. Step: Upload An Image</strong></h3>
						<div class="fileWrapper">
							<a class="fileButton">Upload Image</a>
							<input name="photo" id="file" class="fileInput" size="27" type="file" />	
						</div>
						<input type="hidden" name="width" value="<?=$canvasWidth?>" />
						<input type="hidden" name="height" value="<?=$canvasHeight?>" />              
						<input type="submit" name="action" value="Upload Image now" class="inputSubmit" />
					</form>
					<div id="notice" class="notice">Uploading...</div>
				</div>
				<!-- first step upload image end -->
				
				<div class="content">
					
					<!-- second step selection begin -->
					<div id="uploaded">
						<h3><strong>2. Step: Uploaded image - make a selection</strong></h3>
						<div id="div_upload_big" style="width:<?=$bigWidthPrev?>px;height:<?=$bigHeightPrev?>px;"></div>
						<div class="uploadThumbWrapper">
							<?php if($deviceType=='tablet'||$deviceType=='phone') { ?>
							<div class="mobileSelection">
								<a id="selLeft">left</a>
								<a id="selRight">right</a>
								<a id="selUp">up</a>
								<a id="selDown">down</a>
								<a id="selResize">bigger</a>
								<a id="selResizeSmall">smaller</a>
							</div>
							<?php } ?>
							<form name="upload_thumb" id="upload_thumb" class="uploaderForm" method="post" action="upload.php?act=thumb" target="upload_target">
								<input type="hidden" name="img_src" id="img_src" class="img_src" /> 
								<input type="hidden" name="height" value="0" id="height" class="height" />
								<input type="hidden" name="width" value="0" id="width" class="width" />
								<input type="hidden" id="y1" class="y1" name="y" />
								<input type="hidden" id="x1" class="x1" name="x" />
								<input type="hidden" id="y2" class="y2" name="y1" />
								<input type="hidden" id="x2" class="x2" name="x1" />                         
								<input type="submit" value="create thumbnail now" class="inputSubmit" />
							</form>
							<div id="notice2" class="notice">Thumb generating in progress...</div>
						</div>
					</div>
					<!-- second step selection end -->
					
					<!-- preview the selection begin -->
					<div class="previewWindow">
						<h3>Selection preview</h3>
						<div class="previewWrapper" style="width:<?=$bigWidthPrev?>px;height:<?=$bigHeightPrev?>px;">
							<div id="preview"></div>
						</div>
					</div>
					<!-- preview the selection end -->

					<!-- third step generated thumb begin -->
					<div id="thumbnail">
						<div class="thumbWrapper" style="width:<?=$bigWidthPrev?>px;height:<?=$bigHeightPrev?>px;">
							<h3><strong>3. Step: Generated thumbnail</strong></h3>
							<div id="div_upload_thumb"></div>
						</div>
						<div class="detailWrapper">
							<h3>Selection / thumbnail details</h3>
							<div id="details">
								<table width="360" cellpadding="4" cellspacing="0">
									<tr>
										<td>Image source:</td>
										<td><input type="text" name="img_src" class="img_src" size="40" value="" /></td>
									</tr>
									<tr>
										<td>Width:</td>
										<td><input type="text" name="width" class="width" size="5" value="" /></td>
									</tr>
									<tr>
										<td>Height:</td>
										<td><input type="text" name="height" class="height" size="5" value="" /></td>
									</tr>
									<tr>
										<td>X1:</td>
										<td><input type="text" class="x1" size="5" value="" /></td>
									</tr>
									<tr>
										<td>Y1:</td>
										<td><input type="text" class="y1"  size="5" value="" /></td>
									</tr>
									<tr>
										<td>X2:</td>
										<td><input type="text" class="x2" size="5" value="" /></td>
									</tr>
									<tr>
										<td>Y2:</td>
										<td><input type="text" class="y2" size="5" value="" /></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<!-- third step generated thumb end -->
					
				</div>
				
				<!-- hidden iframe begin -->
				<iframe id="upload_target" name="upload_target" src=""></iframe>
				<!-- hidden iframe end -->

			</div>

		</div>
		<!-- content wrapper end -->
		
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
		<script type="text/javascript" src="js/effects.js"></script>
		<?php if($deviceType=='tablet'||$deviceType=='phone') { ?>
		<script type="text/javascript" src="js/touch.js"></script>
		<?php } ?>

	</body>
</html>