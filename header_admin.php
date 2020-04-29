<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("username2")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=index.php'>";
			exit(); 
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ส่วนหัวระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<link href="mystyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bottom_border"> 
  <tr>
    <td background="images/meeting_04.png"><img src="images/logo.png" width="420" height="110" /></td>
    <td valign="bottom" background="images/meeting_04.png"><div align="right">
	<img src="images/iplog.gif" width="16" height="16" align="absmiddle" /> <a href="user_logs.php" class="texttop" target="rightframe">ประวัติการเข้าใช้งาน</a> 
	| <img src="images/organization_icon.png" width="16" height="16" align="absmiddle" /> <a href="changedata_organize.php" class="texttop" target="rightframe">แก้ไขข้อมูลหน่วยงาน</a> 
	| <img src="images/icon_key.gif" width="16" height="16" align="absmiddle" /> <a href="changepass.php" class="texttop" target="rightframe">เปลี่ยนรหัสผ่าน</a> 
	| <img src="images/logout.png" width="16" height="16" align="absmiddle" /> <a href="index.php" class="texttop" target="_parent">ออกจากระบบ</a> 	
	</div></td>
  </tr>
</table>


</body>
</html>

<?
	}
	?>
