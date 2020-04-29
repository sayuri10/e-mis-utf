<?php
//to2n
try
{
ini_set('memory_limit', '-1');
include'inc/connect_db.php';
$book_detail_id=$_GET["book_detail_id"];
$sql="select * from sbk_book where id=$book_detail_id  ";
				$dbquery=mysql_db_query($dbname, $sql);
				while($result=mysql_fetch_array($dbquery))
				{
					$detailbook_file1=$result['file1'];
				}
$ttx="uploads/".$detailbook_file1."[0]";
$im = new Imagick();
$im->setResolution(200,200); 
$im->readImage($ttx);
$im->resizeImage(800 ,1100, imagick::FILTER_LANCZOS, 1,true);
$im->setImageFormat( "jpg" );
$im->sharpenImage(0,1);
$im->levelImage (10, 1, 65535);
/* take this out to2n beg*/
$draw = new ImagickDraw();
$draw->setFillColor('gray70');
$draw->setFont('THKRUB.TTF');
$draw->setFontSize(25);
$im->annotateImage($draw, 50, 200, -20, '* * * ตัวอย่างเอกสาร สำนักงาน กศน.จ.เลย * * *');
 /*take this out to2n end*/
header( "Content-Type: image/jpeg" );
echo $im;
mysql_close();
$draw->clear();
$draw->destroy();
$im->clear();
$im->destroy();
}
catch(Exception $e)
{
	 echo $e->getMessage();
}
 ?>