<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("username2")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=index.php'>";
			exit(); 
} else {

		$username2=$_SESSION["username2"]; 
		$username_id=$_SESSION["username_id"]; 
		$userorganize_id=$_SESSION["userorganize_id"]; 
	include 'inc/connect_db.php';

	$curDay = date("j");
	$curMonth = date("n");
	$curYear = date("Y")+543;
	$year=date("Y");
	
	//$today="$curDay-$curMonth-$curYear";
?>
<?php
//แปลงวันที่ไทย
		$username2=$_SESSION["username2"]; 
		$username_id=$_SESSION["username_id"]; 
		$userorganize_id=$_SESSION["userorganize_id"]; 

function thai_date($strDate)	{
		$strYear = date("y",strtotime($strDate))+43;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear เวลา $strHour:$strHour:$strSeconds";
	}


?>

<? $today="$curDay $showmonth $curYear"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link href="mystyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br>

<table width="95%" border="0" bgcolor="#99FFCC" cellspacing="1"  align="center" class="headtable">
  <tr >
    <td>
	<div align="left"><b>สถิติการเข้าใช้งานระบบรับ-ส่งหนังสือราชการ : Transmission Missive System <?=$num_logs?> ครั้งล่าสุด </b></div>
<?
$sql1="";//Query amphure

	echo "<table width=\"100%\" border=\"0\" cellpadding=\"1\"  align=\"center\" class=\"title_table\" bgcolor=\"#DFEFFF\"><TR align=\"center\">";
	?>
<td> ที่ </td>
<td> วันเดือนปีที่เข้าระบบ</td>
<td> IP Address</td>
<td> หมายเหตุ </td>
</tr>
	<?
$num=1;
$sql1="SELECT * FROM sbk_userlogs  WHERE username='$username_id'  order by timeStart  desc";
$query1=mysql_db_query($dbname, $sql1) or die(mysql_error()."by command".$sql1);
while($result1=mysql_fetch_array($query1)){
			$timestart_th=$result1["timeStart"];
			$ip_addr=$result1["ip_addr"];

			echo "<tr align=\"center\" bgcolor=\"#FFFFFF\"><td>$num</td>";
			echo "<td>$timestart_th</td>";
			echo "<td>$ip_addr</td>";
			echo "<td>&nbsp;</td></tr>";
				$num++;		
			}

echo "</table>";
echo"</td></tr></table>";

?>

<? mysql_close();  
}
  ?>