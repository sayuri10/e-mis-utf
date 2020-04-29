<?php
/* Create some objects */
$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );

/* New image */
$image->newImage(800, 75, $pixel);

/* Black text */
$draw->setFillColor('black');

/* Font properties */
//$draw->setFont('Bookman-DemiItalic');
$draw->setFont('Kinnari.ttf');
$draw->setFontSize( 30 );

/* Create text */
$image->annotateImage($draw, 10, 45, 0, 'กศน The quick brown fox jumps over the lazy dog');

/* Give image a format */
$image->setImageFormat('jpeg');

/* Output the image with headers */
header('Content-type: image/jpeg');
echo $image;

?>