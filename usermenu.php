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
</head>

<body bgcolor="#CCCCCC" class="right_border">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="right_border">  
  <tr>
    <td align="center">
	<br>
	<FONT  COLOR="#008040"><b>-:- ยินดีต้อนรับ -:-</b></FONT>
	<br>
<?	
	//แสดงชื่อเข้าระบบ
	$sql="select name from sbk_organize where id=$userorganize_id";
	$dbquery=mysql_db_query($dbname, $sql);
	$result=mysql_fetch_array($dbquery);
	$nameorganize=$result[name];
	echo $nameorganize; 
?>
<br><br>
	</td>
  </tr>
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_blue">
      <tr>
        <td class="title_bg_text_no_center_green"><img src="images/application.gif" width="16" height="16" align="absmiddle" /> เมนูหลัก</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          
          <tr>
            <td class="blue_bg_color"><img src="images/icon/new_doc.png" width="21" height="21" align="absmiddle" /><a href="doc_receive.php"  class="text" target="rightframe"> หนังสือเข้าใหม่</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/icon/send_school.png" width="21" height="21" align="absmiddle" /><a href="sendbook.php"  class="text" target="rightframe"> ส่งหนังสือให้ กศน.อำเภอ</a></td>
          </tr>
    <?  //แก้เขตพื้นที่ไม่ต้องส่งให้เขตพื้นที่
				//หากลุ่มหน่วยงาน
				$sql7="select groupID from sbk_organize where id=$userorganize_id ";
				$db_query7=mysql_db_query($dbname,$sql7);
					while($result7 = mysql_fetch_array($db_query7))
					{
							$group_id="".$result7[0]."";								
					}
				//หาประเภทหน่วยงาน
				$sql1="select typeID from sbk_group where id=$group_id ";
				$db_query1=mysql_db_query($dbname,$sql1);
					while($result1 = mysql_fetch_array($db_query1))
					{
							$type_id="".$result1[0]."";								
					}
			if($type_id==1)   //ถ้าเป็นโรงเรียนให้แสดง
				{
	?>
		  <tr>
            <td class="blue_bg_color"><img src="images/icon/send_area.png" width="21" height="21" align="absmiddle" /><a href="sendbookarea.php"  class="text" target="rightframe"> ส่งหนังสือให้ กศน.จังหวัด</a></td>
          </tr>
          <tr>
    <?
	}
	?>		
			<td class="blue_bg_color"><img src="images/icon/send_news.png" width="21" height="21" align="absmiddle" /><a href="add_news.php"  class="text"  target="rightframe"> ส่งข่าวประชาสัมพันธ์</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/icon/cancel_doc.png" width="21" height="21" align="absmiddle" /><a href="doc_cancel.php"  class="text" target="rightframe"> หนังสือเข้าที่ถูกยกเลิก</a></td>
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
        <td class="title_bg_text_no_center_green"><img src="images/application.gif" width="16" height="16" align="absmiddle" /> ค้นหาและรายงาน</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          
          <tr>
            <td class="blue_bg_color"><img src="images/icon/search.png" width="21" height="21" align="absmiddle" /><a href="doc_all_receive.php"  class="text" target="rightframe"> หนังสือเข้าที่รับแล้ว</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/icon/search.png" width="21" height="21" align="absmiddle" /><a href="doc_all_send.php"  class="text" target="rightframe"> หนังสือออก</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/icon/report_receive.png" width="21" height="21" align="absmiddle" /><a href="doc_report_receive.php"  class="text" target="rightframe"> รายงานหนังสือเข้า</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/icon/report_send.png" width="21" height="21" align="absmiddle" /><a href="doc_report_send.php"  class="text"  target="rightframe"> รายงานหนังสือออก</a></td>
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
        <td class="title_bg_text_no_center_green"><img src="images/application.gif" width="16" height="16" align="absmiddle" /> ข้อมูลผู้ใช้</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          
          <tr>
            <td class="blue_bg_color"><img src="images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="user_logs.php"  class="text" target="rightframe">ประวัติการเข้าใช้งาน</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="changedata_organize.php"  class="text" target="rightframe">แก้ไขข้อมูลหน่วยงาน</a></td>
          </tr>
          <tr>
            <td class="blue_bg_color"><img src="images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="changepass.php"  class="text" target="rightframe">เปลี่ยนรหัสผ่าน</a></td>
          </tr>
          <tr>
            <td class="yellow_bg_color"><img src="images/arrow_right.gif" width="16" height="16" align="absmiddle" /><a href="index.php" target="_parent" class="text">ออกจากระบบ</a></td>
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