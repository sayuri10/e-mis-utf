<?php
$hostname = "localhost";
$user = "root";
$password = "zzz";
$dbname = "e-missive";
$connection=mysql_connect($hostname, $user, $password) or die("ติดต่อฐานข้อมูลไม่ได้");
//mysql_query("SET NAMES tis620",$connection);
mysql_query("SET NAMES UTF8",$connection);
$masternumbook = "ศธ 04115";
$folder_downloadfile="uploads2";
$TRbgcolorBookformal=array("#CCFFCC","#FBF7EE","#F2FFF2","#FFFFCC","#E9D7F4","#F4F4F4","#E8FFB3","#FEA25d","#CCFFCC","#FBF7EE","#F2FFF2","#FFFFCC","#E9D7F4","#F4F4F4","#E8FFB3","#FEA25d");
$Per_Pages=30;//จำนวนหนังสือในหน้าทั่วไป
$Page_index=30;//จำนวนหนังสือในหน้าแรก
$Page_report=30;//จำนวนหนังสือในหน้ารายงาน
$Per_Pages_saraban=30;//จำนวนหนังสือในหน้าสารบรรณกลาง
$show_top_saraban=50;//จำนวนหนังสือที่แสดงหน้าของสารบรรณกลาง
$search_no_start="2011-01-01";//กรณีกรอกวันที่ไม่ครบให้ค้นหาเริ่มตั้งแต่วันที่  yyyy-mm-dd
$num_logs=20;//จำนวน Log Login ที่เก็บ
$doc_central="สารบรรณกลาง";//ชื่อสารบรรณกลาง
$sum_location_bookto=" where from_type=1 and to_type=2 ";//ค้นหาหนังสือเข้าสารบรรณกลาง
$sum_location_bookfrom="  where from_type=2 and to_type=1 ";//ค้นหาหนังสือออกสารบรรณกลาง
$showtitilebar="ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System";//ชื่อ titlebar
//$sql="select day from meeting_day";
//$dbquery=mysql_db_query($dbname, $sql);
//$result=mysql_fetch_array($dbquery);
//$config_day=$result[0];
?>