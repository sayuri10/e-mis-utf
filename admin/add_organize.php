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
	
	if($_GET["edit_organize_id"]) $edit_organize_id=$_GET["edit_organize_id"];

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

<body >
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> บันทึกหน่วยงาน</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<?
		if(!$edit_organize_id)
		{
	?>
	<form action="add-function.php" method="post"  name="form1">
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td colspan="2" class="bg_colorCopy"><img src="../images/add.gif" width="16" height="16" align="absmiddle" /> เพิ่มหน่วยงาน </td>
        </tr>
      
      <tr>
        <td width="153" class="bg_color"><div align="right">ชื่อหน่วยงาน : </div></td>
        <td width="957" class="yellow_bg_color"><input name="organize_name" type="text" id="organize_name"  size="30" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">เลขหนังสือออก : </div></td>
        <td class="yellow_bg_color"><input name="organize_numbook" type="text" id="organize_numbook"  size="30" value="<? echo $masternumbook; ?>" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">รหัส SMIS : </div></td>
        <td class="yellow_bg_color"><input name="organize_smis" type="text" id="organize_smis"  size="30" /></td>
      </tr>
	  <tr>
        <td class="bg_color"><div align="right">กลุ่ม/เครือข่าย : </div></td>
        <td class="yellow_bg_color">
		  <select name="groupid" id="groupid" width="30">
					<?php
						$sql3="select * from sbk_group order by  typeID desc,locationID ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$group_id=$result3["id"];
							$group_name=$result3["name"];
							$group_typeid=$result3["typeID"];		
							echo   "<option value=\"$group_id\"> $group_name </option> \n";
         			}
					mysql_close($dbname);
				?>
      </select>
		</td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right"> ตำบล : </div></td>
        <td class="yellow_bg_color"><input name="organize_thumbol" type="text" id="organize_thumbol"  size="30" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right"> E-MAIL : </div></td>
        <td class="yellow_bg_color"><input name="organize_email" type="text" id="organize_email"  size="30" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right"> โทรศัพท์ : </div></td>
        <td class="yellow_bg_color"><input name="organize_telephone" type="text" id="organize_telephone"  size="30" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">สถานะการใช้งาน : </div></td>
        <td class="yellow_bg_color">
		<input name="organize_status" type="radio" value="1" id="organize_status" checked> ใช้งาน 
        <input name="organize_status" type="radio" value="2" id="organize_status" > ไม่ใช้งาน 
		</td>
		</tr>
      
	   <tr>
        <td class="bg_color">&nbsp;</td>
        <td class="yellow_bg_color"><input type="button" name="Button" value="บันทึก"  onclick="chkform();"/> <input type="reset" name="Reset" value="ยกเลิก" /></td>
      </tr>
    </table>
	</form>
	
	<?
		}else if($edit_organize_id)
		{
			$sql="select * from sbk_organize where id='$edit_organize_id' ";
			$dbquery=mysql_db_query($dbname, $sql);
			$result=mysql_fetch_array($dbquery);
			
			$edit_organize_id=$result[id];
			$edit_organize_name=$result[name];
			$edit_organize_numbook=$result[num_book];
			$edit_organize_smis=$result[smis];
			$edit_organize_groupid=$result[groupID];
			$edit_organize_thumbol=$result[thumbol];
			$edit_organize_email=$result[email];
			$edit_organize_telephone=$result[telephone];
			$edit_organize_status=$result[status];

	?>
	<form action="edit-function.php" method="post" name="form2">
	  <table width="100%" border="0" cellspacing="3" cellpadding="2">
        <tr>
          <td colspan="2" class="bg_colorCopy"><img src="../images/drive_edit.gif" width="16" height="16" align="absmiddle" /> แก้ไขหน่วยงาน</td>
        </tr>
        
        <tr>
          <td width="133" class="bg_color"><div align="right">ชื่อหน่วยงาน : </div></td>
          <td width="977" class="yellow_bg_color"><input name="edit_organize_name" type="text" id="edit_organize_name" value="<? echo $edit_organize_name; ?>" size="30" />
		  <input name="edit_organize_id" type="hidden" id="edit_organize_id" value="<? echo $edit_organize_id; ?>" /></td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">เลขหนังสือออก : </div></td>
          <td class="yellow_bg_color"><input name="edit_organize_numbook" type="text" id="edit_organize_numbook" value="<? echo $edit_organize_numbook; ?>" size="30" />
		  </td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">รหัส SMIS : </div></td>
          <td class="yellow_bg_color"><input name="edit_organize_smis" type="text" id="edit_organize_smis" value="<? echo $edit_organize_smis; ?>" size="30" />
		  </td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">กลุ่ม/เครือข่าย : </div></td>
          <td class="yellow_bg_color">
		  		  <select name="edit_groupid" id="edit_groupid" width="30" OnChange() >
					<?php
						$sql3="select * from sbk_group order by  typeID desc,locationID ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$group_id=$result3["id"];
							$group_name=$result3["name"];	
							$group_typeid=$result3["typeID"];	
							echo   "<option value=\"$group_id \"  ";
							if($group_id==$edit_organize_groupid) echo "selected"; 
							echo "> $group_name </option> \n";
         			}
					mysql_close($dbname);
					?>
			      </select>
		  </td>
		</tr>
        <tr>
          <td class="bg_color"><div align="right">ตำบล : </div></td>
          <td class="yellow_bg_color"><input name="edit_organize_thumbol" type="text" id="edit_organize_thumbol" value="<? echo $edit_organize_thumbol; ?>" size="30" />
		  </td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">E-MAIL : </div></td>
          <td class="yellow_bg_color"><input name="edit_organize_email" type="text" id="edit_organize_email" value="<? echo $edit_organize_email; ?>" size="30" />
		  </td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">โทรศัพท์ : </div></td>
          <td class="yellow_bg_color"><input name="edit_organize_telephone" type="text" id="edit_organize_telephone" value="<? echo $edit_organize_telephone; ?>" size="30" />
		  </td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">สถานะการใช้งาน : </div></td>
		<td>
		<input name="organize_status" type="radio" value="1" id="organize_status" <? if($edit_organize_status==1) echo "checked";?> > ใช้งาน 
        <input name="organize_status" type="radio" value="2" id="organize_status" <? if($edit_organize_status==2) echo "checked";?>> ไม่ใช้งาน 
	
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
        <td class="bg_colorCopy"><img src="../images/report.gif" width="16" height="16" align="absmiddle" /> หน่วยงานทั้งหมด </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="50">รหัส</td>
            <td width="180">ชื่อหน่วยงาน</td>
            <td width="80">เลขหนังสือ</td>
            <td width="120">กลุ่ม</td>
            <td width="60">โทรศัพท์</td>
            <td width="120">ประเภท</td>
            <td width="50">สถานะ </td>
            <td width="90">ดำเนินการ</td>
          </tr>
		  <?
		  		$sql="select * from sbk_organize order by smis ";
				$dbquery=mysql_db_query($dbname, $sql);
				
				while($result=mysql_fetch_array($dbquery))
				{
					$organize_id=$result[id];
					$organize_name=$result[name];
					$organize_numbook=$result[num_book];
					$organize_smis=$result[smis];
					$organize_groupid=$result[groupID];
					$organize_thumbol=$result[thumbol];
					$organize_email=$result[email];
					$organize_telephone=$result[telephone];
					$organize_status=$result[status];

						$sql3="select * from sbk_group where id=$organize_groupid ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$group_typeid=$result3["typeID"];
							$group_name=$result3["name"];		
					}
						$sql4="select * from sbk_type where id=$group_typeid ";
						$db_query4=mysql_db_query($dbname,$sql4);
					while($result4 = mysql_fetch_array($db_query4))
					{
							$type_name=$result4["name"];		
					}
						


					if($bg == "#DFE6F1") { //ส่วนของการ สลับสี 
					$bg = "#F8F7DE";
					} else {
					$bg = "#DFE6F1";
					}
					
					echo"<tr class='text' bgcolor='$bg'>
						<td align='center'>$organize_id</td>
						<td >&nbsp;$organize_name</td>
						<td >&nbsp;$organize_numbook</td>
						<td align='center'>&nbsp;$group_name</td>
						<td align='center'>&nbsp;$organize_telephone</td>
						<td align='center'>&nbsp;$type_name</td>
						<td align='center'>&nbsp;$organize_status</td>
						<td align='center'><a href='add_organize.php?edit_organize_id=$organize_id' class='textnormal'>แก้ไข</a> | <a href='delete-function.php?del_organize_id=$organize_id' class='textnormal'>ลบ</a></td>
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
	if(document.form1.organize_name.value == 0)
	{
		alert("กรุณาระบุชื่อหน่วยงาน");
		document.form1.organize_name.focus();
	}else
	if(document.form1.organize_numbook.value == 0)
	{
		alert("กรุณาระบุเลขหนังสือออก");
		document.form1.organize_numbook.focus();
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
	if(document.form2.edit_organize_name.value == 0)
	{
		alert("กรุณาระบุชื่อหน่วยงาน");
		document.form2.edit_organize_name.focus();
	}else
	if(document.form2.edit_organize_numbook.value == 0)
	{
		alert("กรุณาระบุเลขหนังสือออก");
		document.form2.edit_organize_numbook.focus();
	}else
	document.form2.submit();
}

</script>
<? mysql_close(); 
}
?>