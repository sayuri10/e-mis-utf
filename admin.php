<?
	session_start();
	session_destroy();
	error_reporting(E_ALL^E_NOTICE);
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
	background-color: #E5E5E5;
}
-->
</style></head>

<body onload="document.form1.username.focus();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><? include 'header.php'; ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="22%" valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">
          <form action="chkadmin.php" method="post" name="form1">
		  <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
            <tr>
              <td class="title_table_blue"><img src="images/icon_key.gif" width="16" height="16" align="absmiddle" /> Administrator Login Form </td>
              </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="2" cellpadding="5">
                
                <tr>
                  <td width="32%" class="blue_bg_color"><strong>username : </strong></td>
                  <td width="68%" class="yellow_bg_color"><input name="username" type="text" id="username" /></td>
                </tr>
                <tr>
                  <td class="blue_bg_color"><strong>password : </strong></td>
                  <td class="yellow_bg_color"><input name="passwords" type="password" id="passwords" /></td>
                </tr>
          <tr bgcolor="#FFEAF4">
            <td bgcolor="#FFEAF4" colspan="2" align="center" >&nbsp;ป้อนรหัสลับการเข้าระบบ : 
				<img src="captcha/captcha_img.php">
			<input type="text" name="capt">
		</td>
          </tr>
                <tr>
                  <td class="blue_bg_color">&nbsp;</td>
                  <td class="yellow_bg_color"><input type="button" name="Button" value="Login"  onclick="chkform();"/>
                      <input type="reset" name="Reset" value="สุ่มรหัสใหม่" onclick="window.location='admin.php'" /></td>
                </tr>
              </table></td>
              </tr>
          </table>
		  </form>
        </td>
        </tr>
      <tr>
        <td valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
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
function chkform()
{
	if(document.form1.username.value == 0)
	{
		alert("please fill username");
		document.form1.username.focus();
	}else 
	if(document.form1.passwords.value == 0)
	{
		alert("please fill passwords");
		document.form1.passwords.focus();
	}else
	document.form1.submit();
}
</script>