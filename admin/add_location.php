<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	include '../inc/connect_db.php';

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=../index.php'>";
			exit(); 
} else {


	$admin_name=$_SESSION["admin_name"]; 
	$admin_id=$_SESSION["admin_id"]; 

		if($_GET["edit_location_id"]) $edit_location_id=$_GET["edit_location_id"];

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
	background-color: #e5e5e5;
}
-->
</style></head>

<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> บันทึกที่ตั้ง</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<?
		if(!$edit_location_id)
		{
	?>
	<form action="add-function.php" method="post"  name="form1">
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td colspan="2" class="bg_colorCopy"><img src="../images/add.gif" width="16" height="16" align="absmiddle" /> เพิ่มที่ตั้ง</td>
        </tr>
      
      <tr>
        <td width="133" class="bg_color"><div align="right">ชื่อที่ตั้ง : </div></td>
        <td width="977" class="yellow_bg_color"><input name="location_name" type="text" id="location_name" size="30"/></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">สถานะ : </div></td>
        <td class="yellow_bg_color">
		<input name="location_status" type="radio" value="1" id="location_status" checked> ใช้งาน 
        <input name="location_status" type="radio" value="2" id="location_status" > ไม่ใช้งาน 
		</td>
      </tr>
      
      <tr>
        <td class="bg_color">&nbsp;</td>
        <td class="yellow_bg_color"><input type="button" name="Button" value="บันทึก"  onclick="chkform();"/> <input type="reset" name="Reset" value="ยกเลิก" /></td>
      </tr>
    </table>
	</form>
	
	<?
		}else if($edit_location_id)
		{
			$sql="select * from sbk_location where id='$edit_location_id' ";
			$dbquery=mysql_db_query($dbname, $sql);
			$result=mysql_fetch_array($dbquery);
			
			$edit_location_name=$result[name];
			$edit_location_status=$result[status];
	?>
	<form action="edit-function.php" method="post" name="form2">
	  <table width="100%" border="0" cellspacing="3" cellpadding="2">
        <tr>
          <td colspan="2" class="bg_colorCopy"><img src="../images/drive_edit.gif" width="16" height="16" align="absmiddle" /> แก้ไขที่ตั้ง </td>
        </tr>
        
        <tr>
          <td width="133" class="bg_color"><div align="right">ชื่อที่ตั้ง : </div></td>
          <td width="977" class="yellow_bg_color"><input name="edit_location_name" type="text" id="edit_location_name" value="<? echo $edit_location_name; ?>" /></td>
        </tr>
        <tr>
          <td class="bg_color"><div align="right">สถานะ : </div></td>
          <td class="yellow_bg_color">
		<input name="location_status" type="radio" value="1" id="location_status" <? if($edit_location_status==1) echo "checked";?> > ใช้งาน 
        <input name="location_status" type="radio" value="2" id="location_status" <? if($edit_location_status==2) echo "checked";?>> ไม่ใช้งาน 
	   <input name="edit_location_id" type="hidden" id="edit_location_id" value="<? echo $edit_location_id; ?>" /></td>
        </tr>

        <tr>
          <td class="bg_color">&nbsp;</td>
          <td class="yellow_bg_color"><input type="button" name="Button2" value="บันทึก"  onclick="chkform2();"/>
              <input type="reset" name="Reset2" value="ยกเลิก" /></td>
        </tr>
      </table>
	  </form>
	<? } ?>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td class="bg_colorCopy"><img src="../images/report.gif" width="16" height="16" align="absmiddle" /> ที่ตั้งทั้งหมด </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="61%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="140">รหัสหน่วยงาน</td>
            <td width="346">ชื่อหน่วยงาน</td>
            <td width="100">สถานะ </td>
            <td width="110">ดำเนินการ</td>
          </tr>
		  <?
		  		$sql="select * from sbk_location order by id";
				$dbquery=mysql_db_query($dbname, $sql);
				
				while($result=mysql_fetch_array($dbquery))
				{
					$location_id=$result[id];
					$location_name=$result[name];
					$location_status=$result[status];
					
					
					if($bg == "#DFE6F1") { //ส่วนของการ สลับสี 
					$bg = "#F8F7DE";
					} else {
					$bg = "#DFE6F1";
					}
					
					echo"<tr class='text' bgcolor='$bg'>
						<td align='center'>$location_id</td>
						<td>&nbsp;$location_name</td>
						<td align='center'>&nbsp;$location_status</td>
						<td align='center'><a href='add_location.php?edit_location_id=$location_id' class='textnormal'>แก้ไข</a> | <a href='delete-function.php?del_location_id=$location_id' class='textnormal'>ลบ</a></td>
					</tr>";
				}
		  ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
<script language="javascript">
function chkform()
{
	if(document.form1.location_name.value == 0)
	{
		alert("กรุณาระบชื่อที่ตั้ง");
		document.form1.location_name.focus();
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
	if(document.form2.edit_location_name.value == 0)
	{
		alert("กรุณาระบชื่อที่ตั้ง");
		document.form2.edit_location_name.focus();
	}else
	document.form2.submit();
}

</script>
<? mysql_close(); 
}
?>