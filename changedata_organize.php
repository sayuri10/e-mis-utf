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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<link href="mystyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #e5e5e5;
}
-->
</style></head>

<body onload="document.form1.old_pass.focus();">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="images/application_form_edit.gif" alt="title" width="16" height="16" align="absmiddle" /> แก้ไขข้อมูลหน่วยงาน</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="edit-function.php" name="form1" method="post">
	<table width="630" border="0" cellspacing="3" cellpadding="2">
<?			
				//ค้นข้อมูลหน่วยงาน
				$sql7="select * from sbk_organize where id=$userorganize_id ";
				$db_query7=mysql_db_query($dbname,$sql7);
					while($result7 = mysql_fetch_array($db_query7))
					{
							$name_org=$result7[name];	
							$numbook_org=$result7[num_book];	
							$thumbol_org=$result7[thumbol];	
							$email_org=$result7[email];	
							$tel_org=$result7[telephone];	
							$web_org=$result7[website];	
							$director_org=$result7[director];	
							$tel_director=$result7[teldirector];	
					}

?>
      <tr>
        <td width="180" class="bg_color"><div align="right">ชื่อหน่วยงาน : </div></td>
        <td width="381" class="yellow_bg_color"><?=$name_org?>
		<!--<input name="name_org" type="text" id="name_org"  size="60" readonly/>-->
		<input name="name_org" type="hidden" id="name_org"  size="60" value="<?=$name_org?>" />
		</td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">เลขที่หนังสือ : </div></td>
        <td class="yellow_bg_color"><?=$numbook_org?>
		<!--<input name="docnum_org" type="text" id="docnum_org" size="60" readonly/>-->
		</td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">ตำบล : </div></td>
        <td class="yellow_bg_color"><input name="thumbol_org" type="text" id="thumbol_org" size="60"  value="<?=$thumbol_org?>"/></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">E-Mail : </div></td>
        <td class="yellow_bg_color"><input name="email_org" type="text" id="email_org" size="60" value="<?=$email_org?>" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">เบอร์โทรศัพท์ : </div></td>
        <td class="yellow_bg_color"><input name="tel_org" type="text" id="tel_org" size="60" value="<?=$tel_org?>" /></td>
      </tr>
	  <tr>
        <td class="bg_color"><div align="right">Website : </div></td>
        <td class="yellow_bg_color"><input name="web_org" type="text" id="web_org" size="60" value="<?=$web_org?>"/></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">ชื่อผู้บริหาร : </div></td>
        <td class="yellow_bg_color"><input name="director_org" type="text" id="director_org" size="60" value="<?=$director_org?>"/></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">เบอร์โทรศัพท์ผู้บริหาร : </div></td>
        <td class="yellow_bg_color"><input name="tel_director" type="text" id="tel_director" size="60" value="<?=$tel_director?>"/></td>
      </tr>

	  <tr>
        <td class="bg_color">&nbsp;</td>
        <td class="yellow_bg_color">
		<input name="userorganize_id" type="hidden" id="userorganize_id"  value="<?=$userorganize_id?>"/>
		<input type="button" name="Button" value="บันทึก" onclick="chkform();" /> <input type="reset" name="Submit2" value="ยกเลิก" /></td>
      </tr>
    </table>
	</form>	</td>
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
	document.form1.submit();
}
</script>
<? mysql_close(); 
}
?>