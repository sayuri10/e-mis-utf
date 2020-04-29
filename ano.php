<?php
ini_set('memory_limit', '-1');

	include'inc/connect_db.php';
$book_detail_id=$_GET["book_detail_id"];
$sql="select * from sbk_book where id=$book_detail_id  ";
				$dbquery=mysql_db_query($dbname, $sql);
				while($result=mysql_fetch_array($dbquery))
				{
					$detailbook_file1=$result['file1'];
				}
$ttx="uploads2/".$detailbook_file1."[0]";

/* Create some objects */
$image = new Imagick();
$image->setResolution(200,200); 
$draw = new ImagickDraw();
//$pixel = new ImagickPixel( 'gray' );

/* New image */
//$image->newImage(800, 75, $pixel);
$image->readImage($ttx);
/* Black text */
$draw->setFillColor('gray70');

/* Font properties */
$draw->setFont('Kinnari.ttf');
$draw->setFontSize( 30 );

/* Create text */
$image->annotateImage($draw, 10, 45, 0, 'สำนักงาน');

/* Give image a format */
//$image->setImageFormat('jpeg');


$image->resizeImage(800 ,1100, imagick::FILTER_SINC, 1);
$image->sharpenImage(0,1);
$image->levelImage (10, 1, 65535);
$image->setImageFormat('jpeg');
$image->setImageDelay(1000000000000);
/* Output the image with headers */
header('Content-type: image/png');
echo $image;
mysql_free_result($dbquery);

?>