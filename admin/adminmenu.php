<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	include '../inc/connect_db.php';

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=../index.php'>";
			exit(); 
} else {

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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="../images/application.gif" width="16" height="16" align="absmiddle" /> เมนูหลัก</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
          
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="saraban/all_documents.php"  class="text" target="rightframe">รายการหนังสือ </a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_user.php"  class="text"  target="rightframe">จัดการผู้ใช้งาน </a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_organize.php" class="text"  target="rightframe">จัดการหน่วยงาน </a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_group.php" class="text"  target="rightframe">จัดการกลุ่ม/เครือข่าย </a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_location.php" class="text"  target="rightframe">จัดการที่ตั้ง </a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_type.php" class="text"  target="rightframe">จัดการประเภทหน่วยงาน </a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="show_news.php" class="text"  target="rightframe">จัดการข่าวสาร </a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_showstat.php" class="text"  target="rightframe">สร้างสถิติแบบตาราง </a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="add_admin.php" class="text"  target="rightframe">เพิ่มผู้ดูแลระบบ </a></td>
          </tr>
        </table></td>
      </tr>
      
      
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
      <tr>
        <td class="title_bg_text_no_center_blue"><img src="../images/application_form_magnify.gif" width="16" height="16" align="absmiddle" /> ข้อมูลส่วนตัว</td>
      </tr>
      
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
          
          <tr>
            <td class="blue_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="changepass.php" class="text"  target="rightframe">เปลี่ยนรหัสผ่าน</a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="../images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="../index.php" target="_parent" class="text">ออกจากระบบ</a></td>
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