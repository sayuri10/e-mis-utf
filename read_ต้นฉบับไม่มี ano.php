<?php
//to2n
ini_set('memory_limit', '-1');

	include'inc/connect_db.php';
$book_detail_id=$_GET["book_detail_id"];
$sql="select * from sbk_book where id=$book_detail_id  ";
				$dbquery=mysql_db_query($dbname, $sql);
				while($result=mysql_fetch_array($dbquery))
				{
					$detailbook_file1=$result[file1];
				}
$ttx="uploads2/".$detailbook_file1."[0]";
//exit();
/*case "scale":
  switch ($data[1])
  {
    case "w":
      $width = $data[2];
      $height = round ($width * $im->getImageHeight () / $im->getImageWidth ());
    break;
    case "h":
      $height = $data[2];
      $width = round ($height * $im->getImageWidth () / $im->getImageHeight ());
    break;
    case "%":
      $width = round (($data[2] / 100) * $im->getImageWidth ());
      $height = round ($width * $im->getImageHeight () / $im->getImageWidth ());
    break;
  }
  if (!isset ($data[3])) $data[3] = 1;
  $im->resizeImage ($width, $height, imagick::FILTER_SINC, $data[3]);
break;*/
$im = new Imagick(); 
//$im = new imagick('434.pdf[0]'); แบบนี้ก็ได้
$im->setResolution(200,200); 
//$im->readImage('file.pdf[0]');
$im->readImage($ttx);
//$im->resampleImage(150,150,imagick::FILTER_UNDEFINED,1);
//$im->resizeImage(1500 ,1500, imagick::FILTER_SINC, 1, true);
$im->resizeImage(800 ,1100, imagick::FILTER_SINC, 1);
$im->setImageDelay(1000000000);

$im->setImageFormat('jpeg');
$im->sharpenImage(0,1);
$im->levelImage (10, 1, 65535);

/* Output the image with headers */
header('Content-type: image/jpeg');
echo $im;

?>