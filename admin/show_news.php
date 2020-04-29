<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=../index.php'>";
			exit(); 
} else {
		
		$admin_name=$_SESSION["admin_name"];
		$admin_id=$_SESSION["admin_id"];
	include '../inc/connect_db.php';
	

?>
<? 
	$monthname=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;
	$showtodaydate_db= date("Y-m-d");
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


//ลบข่าว
	$del_news_id=$_GET["del_news_id"];
	if($del_news_id)
	{	
		$sql="delete from sbk_news where id='$del_news_id'  ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='show_news.php';
	</script>";
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<link href="../mystyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #E5E5E5;
}
-->
</style></head>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" />  ข่าวประกาศ </td>
  </tr>
<tr><td>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td class="bg_colorCopy"><img src="../images/report.gif" width="16" height="16" align="absmiddle" /> ข่าวประกาศที่ส่งแล้ว </td>
      </tr>
      <tr>
        <td><table width="827" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="34">ลำดับที่ </td>
            <td width="250">เนื้อหา</td>
            <td width="86">วันที่เริ่มต้น</td>
            <td width="86">วันที่สิ้นสุด</td>
            <td width="80">สถานะ </td>
            <td width="90">ดำเนินการ</td>
          </tr>
		  <?
				$num=1;
		  		$sql2="select * from sbk_news  order by id desc";
				$dbquery2=mysql_db_query($dbname, $sql2);
				
				while($result2=mysql_fetch_array($dbquery2))
				{
					$news_id=$result2[id];
					$news_start_date=$result2[start_date];
					$news_end_date=$result2[end_date];
					$news_detail=$result2[detail];
					$news_status=$result2[status];


					$news_start_date_th=thai_date($news_start_date);
					$news_end_date_th=thai_date($news_end_date);


					if($bg == "#DFE6F1") { //ส่วนของการ สลับสี 
					$bg = "#F8F7DE";
					} else {
					$bg = "#DFE6F1";
					}
						//แสดงสถานนะหนังสือ
					if($showtodaydate_db<=$news_end_date) { $status_news="ประกาศอยู่";  }
					else{ $status_news="หมดเวลา"; $bg = "#A6A6A6";  }
			
					echo"<tr class='text' bgcolor='$bg'>
						<td align=\"center\">$num </td>
						<td >&nbsp;$news_detail</td>
						<td align=\"center\">$news_start_date_th</td>
						<td align=\"center\">$news_end_date_th</td>
						<td align=\"center\"> $status_news</td>
						<td align='center'><a href='show_news.php?del_news_id=$news_id' class='textnormal'>ลบประกาศ </a></td>
					</tr>";
					$num++;
				}
		  ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
  </tr>
</table>

</body>
</html>

<script language="javascript">
function chkform()
{
	if(document.form1.detail.value == 0)
	{
		alert("กรุณาระบุเนื้อหาของข่าวประกาศครับ");
		document.form1.detail.focus();
	}else
	if(document.form1.long_day.value == 0)
	{
		alert("กรุณาจำนวนวันที่ต้องการประกาศครับ");
		document.form1.long_day.focus();
	}else
	document.form1.submit();
}

function check_keyboard() 
{
	e_k=event.keyCode
	if (((e_k < 48) || (e_k > 47)) && e_k != 46 && e_k != 13) 
	{
	//if (e_k != 13 && (e_k < 48) || (e_k > 57) || e_k == ) {
	event.returnValue = false;
	alert(" เลือกไฟล์โดยการกดปุ่ม Browse...");
	}
}
function chkform2()
{
	if(document.form2.edit_organize.value == 0)
	{
		alert("กรุณาเลือกหน่วยงานครับ");
		document.form2.edit_organize.focus();
	}else
	if(document.form2.edit_username.value == 0)
	{
		alert("กรุณาระบุชื่อผู้ใช้ครับ");
		document.form2.edit_username.focus();
	}else
	if(document.form2.edit_password.value == 0)
	{
		alert("กรุณาระบุรหัสผ่านครับ");
		document.form2.edit_password.focus();	
	}else
	document.form2.submit();
}

</script>
<? mysql_close(); 
}
?>