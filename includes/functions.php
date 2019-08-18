<?php

/**
 * image resizing starts here
 *
 * @param type $arr
 */
function resizeImg($arr)
{

    // name of the file here
    $date = md5(time());

    // upload image and resize
    $uploaddir = $arr['uploaddir'];
    $tempdir = $arr['tempdir'];

    $temp_name = $_FILES['photo']['tmp_name'];

    $img_parts = pathinfo($_FILES['photo']['name']);
    $new_name = strtolower($date . '.' . $img_parts['extension']);

    $ext = strtolower($img_parts['extension']);

    $allowed_ext = array('gif', 'jpg', 'jpeg', 'png');
    if (!in_array($ext, $allowed_ext)) {
        echo '<p class="uperror">' . $arr['fileError'] . '</p>';
        exit;
    }

    $temp_uploadfile = $tempdir . $new_name;
    $new_uploadfile = $uploaddir . $new_name;

    // less than 3MB default
    if ($_FILES['photo']['size'] < $arr['maxfilesize']) {
        if (move_uploaded_file($temp_name, $temp_uploadfile)) {

            // Check EXIF if jpeg
            if ($ext === 'jpg' || $ext === 'jpeg') {
                $arr['orientation'] = checkExifOrientation($temp_uploadfile);
            } else {
                $arr['orientation'] = 1;
            }

            // add key value to arr
            $arr['temp_uploadfile'] = $temp_uploadfile;
            $arr['new_uploadfile'] = $new_uploadfile;

            wideimageImg($arr);

            unlink($temp_uploadfile);
            exit;
        }
    } else {
        echo '<p class="uperror">' . $arr['sizeError'] . '</p>';
        exit;
    }
}

/**
 * resizing the thumb image here
 *
 * @param type $arr
 */
function resizeThumb($arr)
{
    $filename = 'img_thumb_' . uniqid() . '_' . time() . '.png';
    $arr['temp_uploadfile'] = $arr['img_src'];
    $arr['new_uploadfile'] = $arr['uploaddir'] . $filename;
    wideimageImg($arr);
    exit;
}

/**
 * Check the EXIF orientation tag
 *
 * @param type $target
 * @return int
 */
function checkExifOrientation($target)
{
    $exif = exif_read_data($target);
    if (isset($exif['Orientation']) && $exif['Orientation'] != '') {
        return $exif['Orientation'];
    } else {
        return 1;
    }
}

/**
 * convert image with wideimage library
 *
 * @param type $arr
 */
function wideimageImg($arr)
{

    include('lib/wideimage-11.02.19/WideImage.php');
    $wideImage = new WideImage();

    $height = $arr['height'];
    $width = $arr['width'];
    $x = $arr['x'];
    $y = $arr['y'];
    $bigWidth = $arr['bigWidthPrev'];
    $bigHeight = $arr['bigHeightPrev'];
    $tempfileRotate = 'uploads/temp/' . 'img_' . uniqid() . '_temp_' . time() . '.png';

    // load the image
    $workingImg = $wideImage->load($arr['temp_uploadfile']);

    // background color for canvas
    $bg_color = $workingImg->allocateColor($arr['canvasbg']['r'], $arr['canvasbg']['g'], $arr['canvasbg']['b']);

    // fit and add white frame
    if ($arr['thumb'] === true) {
        $workingImg = $workingImg->crop($x, $y, $width, $height)->resize($bigWidth, $bigHeight,
            'inside')->resizeCanvas($bigWidth, $bigHeight, 'center', 'center', $bg_color);
    } else {
        // rotate the image if it is portrait
        switch ($arr['orientation']) {
            case 1: // nothing
                break;
            case 2: // horizontal flip
                break;
            case 3: // 180 rotate left
                $tempi1 = $workingImg->rotate(180);
                // fix for rotated images
                $tempi1->saveToFile($tempfileRotate);
                $workingImg = \WideImage::load($tempfileRotate);
                break;
            case 4: // vertical flip
                break;
            case 5: // vertical flip + 90 rotate right
                break;
            case 6: // 90 rotate right
                $tempi1 = $workingImg->rotate(90);
                // fix for rotated images
                $tempi1->saveToFile($tempfileRotate);
                $workingImg = \WideImage::load($tempfileRotate);
                break;
            case 7: // horizontal flip + 90 rotate right
                break;
            case 8:    // 90 rotate left
                $tempi1 = $workingImg->rotate(-90);
                // fix for rotated images
                $tempi1->saveToFile($tempfileRotate);
                $workingImg = \WideImage::load($tempfileRotate);
                break;
        }
        $workingImg = $workingImg->resize($width, $height, 'inside')->resizeCanvas($width, $height, 'center', 'center',
            $bg_color);
    }

    // always convert to jpg
    $workingImg->saveToFile($arr['new_uploadfile']);

    $data = array(
        'photo' => $arr['new_uploadfile']
    );
    // echo $user_id;
    // delete old file
    echo $data['photo'];
}
