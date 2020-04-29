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

		if($_GET["edit_admin_id"]) $edit_admin_id=$_GET["edit_admin_id"];

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
    <td class="title_bg_text_no_center_blue"><img src="../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> บันทึกผู้ดูแลระบบ</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<?
		if(!$edit_admin_id)
		{
	?>
	<form action="add-function.php" method="post"  name="form1">
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td colspan="2" class="bg_colorCopy"><img src="../images/add.gif" width="16" height="16" align="absmiddle" /> เพิ่มผู้ดูแลระบบ</td>
        </tr>
        <tr>
        <td class="bg_color"><div align="right">ชื่อผู้ดูแลระบบ : </div></td>
        <td class="yellow_bg_color"><input name="user_name" type="text" id="user_name" size="30" /></td>
      </tr>
	    <tr>
        <td class="bg_color"><div align="right">Username : </div></td>
        <td class="yellow_bg_color"><input name="user_username" type="text" id="user_username" size="30" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">Password : </div></td>
        <td class="yellow_bg_color"><input name="user_password" type="text" id="user_password" size="30" /></td>
      </tr>
        <tr>
        <td class="bg_color"><div align="right">สถานะการใช้งาน : </div></td>
        <td class="yellow_bg_color">
		<input name="user_status" type="radio" value="1" id="user_status" checked> ใช้งาน 
        <input name="user_status" type="radio" value="2" id="user_status" > ไม่ใช้งาน 
		</td>
		</tr>

      <tr>
        <td class="bg_color">&nbsp;</td>
        <td class="yellow_bg_color"><input type="button" name="Button" value="บันทึก"  onclick="chkform();"/> <input type="reset" name="Reset" value="ยกเลิก" /></td>
      </tr>
    </table>
	</form>
	
	<?
		}else if($edit_admin_id)
		{
			$sql="select * from sbk_admin where admin_id='$edit_admin_id' ";
			$dbquery=mysql_db_query($dbname, $sql);
			$result=mysql_fetch_array($dbquery);
			
			$user_username=$result[username];
			$user_password=$result[password];
			$user_name=$result[admin_name];
			$edit_user_status=$result[status];

	?>
	<form action="edit-function.php" method="post" name="form2">
	  <table width="100%" border="0" cellspacing="3" cellpadding="2">
        <tr>
          <td colspan="2" class="bg_colorCopy"><img src="../images/drive_edit.gif" width="16" height="16" align="absmiddle" /> แก้ไขผู้ใช้งาน </td>
        </tr>
        
        <tr>
          <td class="bg_color"><div align="right">ชื่อผู้ดูแลระบบ : </div></td>
          <td class="yellow_bg_color"><input name="edit_name" type="text" id="edit_name" value="<? echo $user_name; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="bg_color"><div align="right">Username : </div></td>
          <td class="yellow_bg_color"><input name="edit_username" type="text" id="edit_username" value="<? echo $user_username; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="bg_color"><div align="right">Password : </div></td>
          <td class="yellow_bg_color"><input name="edit_password" type="text" id="edit_password" value="<? echo $user_password; ?>" size="30" />
            <input name="edit_admin_id" type="hidden" id="edit_admin_id" value="<? echo $edit_admin_id; ?>" /></td>
        </tr>
		        <tr>
          <td class="bg_color"><div align="right">สถานะการใช้งาน : </div></td>
		<td>
		<input name="user_status" type="radio" value="1" id="user_status" <? if($edit_user_status==1) echo "checked";?> > ใช้งาน 
        <input name="user_status" type="radio" value="2" id="user_status" <? if($edit_user_status==2) echo "checked";?>> ไม่ใช้งาน 
		  </td>
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
        <td class="bg_colorCopy"><img src="../images/report.gif" width="16" height="16" align="absmiddle" /> ผู้ดูแลระบบทั้งหมด </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="827" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="80">ลำดับที่ </td>
            <td width="175">Username</td>
            <td width="175">Password</td>
            <td width="200">ชื่อผู้ดูแลระบบ</td>
            <td width="80">สถานะ </td>
            <td width="142">ดำเนินการ</td>
          </tr>
		  <?

		  		$sql2="select * from sbk_admin  order by admin_id";
				$dbquery2=mysql_db_query($dbname, $sql2);
				
				while($result2=mysql_fetch_array($dbquery2))
				{
					$user_id=$result2[admin_id];
					$user_username=$result2[username];
					$user_password=$result2[password];
					$user_name=$result2[admin_name];
					$user_status=$result2[status];

					
					if($bg == "#DFE6F1") { //ส่วนของการ สลับสี 
					$bg = "#F8F7DE";
					} else {
					$bg = "#DFE6F1";
					}
					
					echo"<tr class='text' bgcolor='$bg'>
						<td align=\"center\">&nbsp;$user_id</td>
						<td align=\"center\">&nbsp;$user_username</td>
						<td align=\"center\">&nbsp;$user_password</td>
						<td>&nbsp;$user_name</td>
						<td align=\"center\">&nbsp;$user_status</td>
						<td align='center'><a href='add_admin.php?edit_admin_id=$user_id' class='textnormal'>แก้ไข</a> | <a href='delete-function.php?del_admin_id=$user_id' class='textnormal'>ลบ</a></td>
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
</table>

</body>
</html>
<script language="javascript">
function chkform()
{
	if(document.form1.user_organize.value == 0)
	{
		alert("กรุณาเลือกหน่วยงานครับ");
		document.form1.user_organize.focus();
	}else
	if(document.form1.user_username.value == 0)
	{
		alert("กรุณาระบุชื่อผู้ใช้ครับ");
		document.form1.user_username.focus();
	}else
	if(document.form1.user_password.value == 0)
	{
		alert("กรุณาระบุรหัสผ่านครับ");
		document.form1.user_password.focus();	
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