<?
	error_reporting(E_ALL^E_NOTICE);
	include "inc/connect_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<link href="mystyle.css" rel="stylesheet" type="text/css" />
<script language='javascript' src='popcalendar.js'></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
}
-->
</style>

<style type="text/css">
 #capt {
  width: 42px;
  border: solid #CCC 1px;
 }
</style>



</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="images/icon_key.gif" width="16" height="16" align="absmiddle" /> เข้าสู่ระบบรับ-ส่งหนังสือราชการ</td>
        </tr>
      <tr>
        <td>
		  	<form action="chkuser.php"  method="post" name="form3">
		<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          <tr bgcolor="#DFE6F1">
            <td width="38%" bgcolor="#DFE6F1"><div align="right"><img src="images/icon/username.png" width="18" height="18" align="absmiddle" /> ชื่อผู้ใช้: </div></td>
            <td width="52%"><input name="username" type="text" id="username"  size="15"></td>
          </tr>
          <tr bgcolor="#F8F7DE">
            <td bgcolor="#F8F7DE"><div align="right"><img src="images/icon/password.png" width="18" height="18" align="absmiddle" /> รหัสผ่าน: </div></td>
            <td><input name="passwords" type="password" id="passwords" size="15"></td>
          </tr>
          <tr bgcolor="#FFEAF4">
            <td bgcolor="#FFEAF4" colspan="2" align="center" >&nbsp;ป้อนรหัสลับการเข้าระบบ : 
				<img src="captcha/captcha_img.php">
			<input type="text" name="capt">
		</td>
          </tr>
            <tr bgcolor="#FFEAF4">
            <td bgcolor="#FFEAF4" colspan="2" align="center"><input   type="button" name="Button2" value="ตกลง" onclick="chkform3();" > |
              <input type="reset" name="Submit2" value="สุ่มรหัสใหม่" onclick="window.location='index.php'">
			</td>
          </tr>
      </table>
		</form>
		</td>
        </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="images/application.gif" width="16" height="16" align="absmiddle" /> คู่มือและสถิติ</div></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          
          <tr>
            <td bgcolor="#DFE6F1"><img src="images/icon/manual.png" width="21" height="21" align="absmiddle" /><a href="manual_missive.pdf"  class="text" target="_blank"> คู่มือการใช้งาน E-Missive</a></td>
          </tr>
          <tr>
            <td bgcolor="#DFE6F1"><img src="images/icon/all_log.png" width="21" height="21" align="absmiddle" /><a href="stat_alllogin.php" class="text" target="_blank"> สถิติการเข้าใช้งาน</a></td>
          </tr>
          <tr>
            <td bgcolor="#DFE6F1"><img src="images/icon/all_log.png" width="21" height="21" align="absmiddle" /><a href="./showmestat" class="text" target="_blank"> สถิติรับ-ส่งแบบตาราง</a></td>
          </tr>
 <!--         <tr>
            <td bgcolor="#DFE6F1"><img src="images/icon/quest.png" width="18" height="18" align="absmiddle" /><a href="question.php" class="text" > ถาม-ตอบ(FAQ)</a></td>
          </tr>		-->
        </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="images/application.gif" width="16" height="16" align="absmiddle" /> การแก้ไขปัญหา</div></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          
          <tr>
            <td bgcolor="#DFE6F1"><img src="images/icon/manual.png" width="21" height="21" align="absmiddle" />กรณีที่ปุ่มแนบไฟล์ไม่ขึ้น<br>ให้เลือกดาวน์โหลดโปรแกรม<br> &nbsp; &nbsp; <a href="FirefoxSetup6.0.exe"  class="text" target="_blank"><img src="images/icon/firefox.png" width="40" height="40" align="absmiddle"  border="0"/></a> &nbsp; &nbsp; <a href="chrome_installer.exe"  class="text" target="_blank"><img src="images/icon/chrome.png" width="40" height="40" align="absmiddle" border="0" /></a> &nbsp; &nbsp; <a href="ie8.exe"  class="text" target="_blank"><img src="images/icon/ie8.png" width="40" height="40" align="absmiddle"  border="0"/></a><br></td>
          </tr>
          <tr>
            <td bgcolor="#DFE6F1"><img src="images/icon/all_log.png" width="21" height="21" align="absmiddle" />ปัญหาอื่นๆ..พบเห็น<br>แจ้ง com@loei.nfe.go.th</td>
          </tr>
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
function chkform3()
{
	if(document.form3.username.value == 0)
	{
		alert("กรุณาระบุชื่อผู้ใช้ก่อนครับ");
		document.form3.username.focus();
	}else 
	if(document.form3.passwords.value == 0)
	{
		alert("กรุณาระบรหัสผ่านก่อนครับ");
		document.form3.passwords.focus();
	}else
	if(document.form3.capt.value == 0)
	{
		alert("กรุณาระบรหัสลับก่อนครับ");
		document.form3.capt.focus();
	}else

	document.form3.submit();
}


function check_number() 
{
	e_k=event.keyCode
	if (((e_k < 48) || (e_k > 47)) && e_k != 46 && e_k != 13) 
	{
	//if (e_k != 13 && (e_k < 48) || (e_k > 57) || e_k == ) {
	event.returnValue = false;
	alert(" กรุณาใส่วันที่ โดยการกดปุ่ม DATE");
	}
}
</script>