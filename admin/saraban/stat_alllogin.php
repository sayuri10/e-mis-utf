<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
			echo"<meta http-equiv='refresh' content='0;URL=../../index.php'>";
			exit(); 
} else {
		
		$admin_name=$_SESSION["admin_name"];
		$admin_id=$_SESSION["admin_id"];
	include '../../inc/connect_db.php';
	

?>
<?
	$curDay = date("j");
	$curMonth = date("n");
	$curYear = date("Y")+543;
	$year=date("Y");
	
	//$today="$curDay-$curMonth-$curYear";
?>
<?php
//แปลงวันที่ไทย

function thai_date($strDate)	{
		$strYear = date("y",strtotime($strDate))+43;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

include('../../inc/connect_db.php');

?>

<? $today="$curDay $showmonth $curYear"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link href="../../mystyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br>
<div align="center"><b>สถิติการเข้าใช้งานระบบรับ-ส่งหนังสือราชการ : Transmission Missive System </b></div>
<table width="95%" border="0" bgcolor="#EBEBEB" cellspacing="1"  align="center">
  <tr >
    <td>
<?
print $arrSchoolmember;
$sql1="";//Query amphure
$sql2="";//query tambon
$sql3="";//query school members


$sql1="SELECT * FROM sbk_group  WHERE (status=1)  order by typeID desc ,id";
$query1=mysql_db_query($dbname, $sql1) or die(mysql_error()."by command".$sql1);
while($result1=mysql_fetch_array($query1)){

			$sql6="select name FROM sbk_location  WHERE (status=1)  and  (id='".$result1["locationID"]."')  ";
			$dbquery6=mysql_db_query($dbname, $sql6);
			$result6=mysql_fetch_array($dbquery6);
			$location_name=$result6[0];


	echo "<table width=\"100%\" border=\"0\" cellpadding=\"1\"  align=\"center\" ><TR ><TD >";
	echo "<b>".$result1["name"]." (".$location_name.")</b>";
	echo "<table width=\"96%\" border=\"0\" bgcolor=\"#DADADA\" cellspacing=\"2\" cellpadding=\"3\" align=\"center\"><TR bgcolor=\"#FFFFFF\">";
	


	$sql2="SELECT * FROM sbk_organize  WHERE (status=1)  and (groupID= '".$result1["id"]."')  ";
	$query2=mysql_db_query($dbname, $sql2) or die(mysql_error()."by command".$sql2);
	$index=1;
	while($result2=mysql_fetch_array($query2)){
		$sum_count_login=0;
		$sql3="SELECT * FROM sbk_user  WHERE (status=1) and (organizeID = '".$result2["id"]."')  ";
		$query3=mysql_db_query($dbname, $sql3) or die(mysql_error()."by command".$sql3);
		while($result3=mysql_fetch_array($query3)){
					$sum_count_login=$sum_count_login+$result3["count_login"];
				}
			$sql4="select max(send_num) from sbk_book where book_from='".$result2["id"]."' ";
			$dbquery4=mysql_db_query($dbname, $sql4);
			$result4=mysql_fetch_array($dbquery4);
			$book_send_num=$result4[0];
				
			$sql5="select max(receive) from sbk_sendbook where book_to='".$result2["id"]."' and receive<>0 ";
			$dbquery5=mysql_db_query($dbname, $sql5);
			$result5=mysql_fetch_array($dbquery5);
			$book_receive_num=$result5[0];


		
						echo "<td>".$result2["name"] ." : ".$sum_count_login." ครั้ง ";
						echo "( ส่ง ".$book_send_num." / รับ ".$book_receive_num." )</td>";

				if($index%3==0){  echo "</tr><tr bgcolor=\"#FFFFFF\">"; 
										}

//					if($index%3==0){
//						echo "<td>".$result2["name"] ." : ".$sum_count_login." ครั้ง</td></tr><tr bgcolor=\"#FFFFFF\">";
//					}else{
//						echo "<td>".$result2["name"] ." : ".$sum_count_login." ครั้ง</td>";
//					}
				$index++;		
			}
echo "</tr></table>";
echo "</td></tr>";
//echo "<tr><td>&nbsp;</td></tr>";
echo "</table>";
	}
echo"</td></tr></table>";

?>

<p align="center">
</p>

<?
}
	?>