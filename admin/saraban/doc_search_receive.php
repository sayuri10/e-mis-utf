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
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;
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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>

	<!-- ปฏิทินภาษาไทย Datepicker  -->
		<link type="text/css" href="../../DatePicker/css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../../uploadify/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="../../DatePicker/js/jquery-ui-1.8.1.offset.datepicker.min.js"></script>
		<style type="text/css">
			/*demo page css*/
			body{ font: 80% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>	

<!---  เสร็จวันที่ -->



<link href="../../mystyle.css" rel="stylesheet"  />
<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #e5e5e5;
}
-->
</style>

</head>
<body >

		<script type="text/javascript">
		var todaydate='<?=$showtodaydate?>';
			$(function(){
				// Datepicker
			  $("#datepicker-th").datepicker({ dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
		</script>
		<script type="text/javascript">
		var todaydate2='<?=$showtodaydate?>';
			$(function(){
				// Datepicker
			  $("#datepicker-th2").datepicker({ dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate2,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-th-22").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-en2").datepicker({ dateFormat: 'dd/mm/yy'});
			  $("#inline2").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
		</script>
		<script type="text/javascript">
		var todaydate2='<?=$showtodaydate?>';
			$(function(){
				// Datepicker
			  $("#datepicker-th3").datepicker({ dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate2,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-th-23").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-en3").datepicker({ dateFormat: 'dd/mm/yy'});
			  $("#inline2").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
		</script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="../../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> ระบบค้นหาหนังสือราชการเข้า</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
   
	<tr>
    <td align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;กรุณาระบุข้อมูลที่ต้องการค้นหา</b></td>
  </tr>
    <tr>
    <form action="search_result_receive.php" name="form1" method="post">
	<td align="center">
		<!-- แทรกตางรางฟอร์มค้นหา -->
		<table width="600" border="0" align="center" cellpadding="3" cellspacing="2" class="borderall_green">
			<tr align="left">
					<td width="50%"><b> &nbsp; &nbsp;เลขที่หนังสือ</b>  &nbsp;<input name="doc_num" type="text" id="doc_num" size="20" /> 
					</td>
					<td ><b>ลงวันที่</b>  &nbsp;<input name="doc_date" type="text" id="datepicker-th" size="20" />
					</td>
			</tr>
			<tr  align="left">
					<td colspan="2"><b>  &nbsp;&nbsp;เรื่อง</b>  &nbsp;<input name="doc_title" type="text" id="doc_title" size="85" />
					</td>
					
			</tr>
			<tr>
					<td align="right"><b>  &nbsp;&nbsp;รับหนังสือวันที่</b>    &nbsp;<input name="start_date_receive" type="text" id="datepicker-th2" size="20" />&nbsp;&nbsp; 
					</td>
					<td  align="left"><b>ถึงวันที่</b>    &nbsp;<input name="last_date_receive" type="text" id="datepicker-th3" size="20" />
					</td>
					
			</tr>
			<tr align="center">
					<td colspan="2"><b><input type="submit" name="Button" value="ค้นหา" /></b>
					</td>
					
			</tr>
		</table>
		<!-- จบแทรกตาราง -->
		
	  </td>
  </form>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
 	  <tr>
        <td  align="right"><img src="../../images/report.gif" width="16" height="16" align="absmiddle" />
		<a href="doc_all_receive.php"  class="text" ><font color="#006633"> ดูหนังสือราชการเข้าทั้งหมด </font></a></td>
      </tr>

  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
<? mysql_close();  
}
  ?>