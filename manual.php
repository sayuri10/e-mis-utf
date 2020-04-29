<?
	error_reporting(E_ALL^E_NOTICE);
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

include('inc/connect_db.php');

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
<div align="center"><b>คู่มือการใช้งานระบบรับ-ส่งหนังสือราชการ : Transmission Missive System </b></div>
<table width="95%" border="0" bgcolor="#EBEBEB" cellspacing="1"  align="center">
  <tr >
    <td>




	</td>
	</tr>
<p align="center">
  <input type="submit" name="Submit" value="ปิดหน้าต่าง" onclick="window.close();" />
</p>
