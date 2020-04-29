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
	background-color: #CCCCCC;
}
-->
</style></head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="right_border">
  <tr>
    <td align="center">
	<br>
	<FONT  COLOR="#008040"><b>-:- ยินดีต้อนรับ -:-</b></FONT>
	<br>
<?	
	echo $admin_name; 
?>
<br><br>
	</td>
  </tr>
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="../images/application.gif" width="16" height="16" align="absmiddle" /> เมนูหลัก</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">

		  <tr>
            <td class="blue_bg_color"><img src="../images/icon/report_receive.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_receive.php"  class="text" target="rightframe">หนังสือเข้าส่งต่อกลุ่มภารกิจ</a></td>
          </tr>
          
          <tr>
            <td class="blue_bg_color"><img src="../images/icon/send.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_top_send.php"  class="text" target="rightframe">หนังสือออก <?=$show_top_saraban;?> รายการล่าสุด</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/icon/receive.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_top_receive.php"  class="text" target="rightframe">หนังสือเข้า <?=$show_top_saraban;?> รายการล่าสุด</a></td>
          </tr>
		  <tr>
            <td class="blue_bg_color"><img src="../images/icon/cancel_doc.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_cancel.php"  class="text" target="rightframe">หนังสือเข้าที่ถูกยกเลิก</a></td>
          </tr>

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
        <td class="title_bg_text_no_center_green"><img src="../images/application.gif" width="16" height="16" align="absmiddle" />ค้นหาและรายงาน</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          
          <tr>
            <td class="blue_bg_color"><img src="../images/icon/search.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_all_receive.php"  class="text" target="rightframe"> ค้นหาหนังสือเข้า</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/icon/search.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_all_send.php"  class="text" target="rightframe"> ค้นหาหนังสือออก</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/icon/report_receive.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_report_receive.php"  class="text" target="rightframe"> รายงานหนังสือเข้า</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/icon/report_send.png" width="21" height="21" align="absmiddle" /><a href="saraban/doc_report_send.php"  class="text"  target="rightframe"> รายงานหนังสือออก</a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>

 <!--
 <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="../images/application.gif" width="16" height="16" align="absmiddle" />ข้อมูลผู้ใช้</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="saraban/stat_alllogin.php"  class="text" target="rightframe">สถิติการใช้งาน</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="changepass.php"  class="text" target="rightframe">เปลี่ยนรหัสผ่าน</a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="../index.php" target="_parent" class="text">ออกจากระบบ</a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
-->
  
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
		alert("กรุณาระบุชื่อผู้ใช้ก่อนครับ");
		document.form1.username.focus();
	}else 
	if(document.form1.passwords.value == 0)
	{
		alert("กรุณาระบรหัสผ่านก่อนครับ");
		document.form1.passwords.focus();
	}else
	document.form1.submit();
}
</script>
<?
}
?>