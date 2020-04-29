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

		if($_GET["edit_group_id"]) $edit_group_id=$_GET["edit_group_id"];

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
    <td class="title_bg_text_no_center_blue"><img src="../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> บันทึกกลุ่ม/เครือข่าย</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<?
		if(!$edit_group_id)
		{
	?>
	<form action="add-function.php" method="post"  name="form1">
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td colspan="2" class="bg_colorCopy"><img src="../images/add.gif" width="16" height="16" align="absmiddle" /> เพิ่มกลุ่ม/เครือข่าย </td>
        </tr>
      
      <tr>
        <td width="153" class="bg_color"><div align="right">ชื่อกลุ่ม/เครือข่าย : </div></td>
        <td width="957" class="yellow_bg_color"><input name="group_name" type="text" id="group_name"  size="30" /></td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">ประเภท : </div></td>
        <td class="yellow_bg_color">
<!---  ลองแก้จ้า...   -->
		  <select name="typeid" id="typeid" width="30">
					<?php
						$sql3="select * from sbk_type order by  id ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$type_id=$result3["id"];
							$type_name=$result3["name"];		
							echo   "<option value=\"$type_id\"> $type_name </option> \n";
         			}
					mysql_close($db);
				?>
      </select>
<!---   ทดลองจ้า....   -->
		</td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">ที่ตั้ง : </div></td>
        <td class="yellow_bg_color">
		<!---  ลองแก้จ้า...   -->
		  <select name="locationid" id="locationid" width="30">
					<?php
						$sql3="select * from sbk_location order by  id ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$location_id=$result3["id"];
							$location_name=$result3["name"];		
							echo   "<option value=\"$location_id\"> $location_name </option> \n";
         			}
					mysql_close($db);
				?>
      </select>
<!---   ทดลองจ้า....   -->
		</td>
      </tr>
      <tr>
        <td class="bg_color"><div align="right">สถานะการใช้งาน : </div></td>
        <td class="yellow_bg_color">
		<input name="group_status" type="radio" value="1" id="group_status" checked> ใช้งาน 
        <input name="group_status" type="radio" value="2" id="group_status" > ไม่ใช้งาน 
		</td>
		</tr>
      
	   <tr>
        <td class="bg_color">&nbsp;</td>
        <td class="yellow_bg_color"><input type="button" name="Button" value="บันทึก"  onclick="chkform();"/> <input type="reset" name="Reset" value="ยกเลิก" /></td>
      </tr>
    </table>
	</form>
	
	<?
		}else if($edit_group_id)
		{
			$sql="select * from sbk_group where id='$edit_group_id' ";
			$dbquery=mysql_db_query($dbname, $sql);
			$result=mysql_fetch_array($dbquery);
			
			$edit_group_name=$result[name];
			$edit_locationid=$result[locationID];
			$edit_typeid=$result[typeID];
			$edit_group_status=$result[status];
			

	?>
	<form action="edit-function.php" method="post" name="form2">
	  <table width="100%" border="0" cellspacing="3" cellpadding="2">
        <tr>
          <td colspan="2" class="bg_colorCopy"><img src="../images/drive_edit.gif" width="16" height="16" align="absmiddle" /> แก้ไขกลุ่ม/เครือข่าย</td>
        </tr>
        
        <tr>
          <td width="133" class="bg_color"><div align="right">ชื่อกลุ่ม/เครือข่าย : </div></td>
          <td width="977" class="yellow_bg_color"><input name="edit_group_name" type="text" id="edit_group_name" value="<? echo $edit_group_name; ?>" size="30" />
		  <input name="edit_group_id" type="hidden" id="edit_group_id" value="<? echo $edit_group_id; ?>" /></td>        
		</tr> 
        <tr>
          <td class="bg_color"><div align="right">ประเภท : </div></td>
          <td class="yellow_bg_color">
		  		  <select name="edit_typeid" id="edit_typeid" width="30">
					<?php
						$sql3="select * from sbk_type order by  id ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$type_id=$result3["id"];
							$type_name=$result3["name"];		
							echo   "<option value=\"$type_id\"  ";
							if($type_id==$edit_typeid) echo "selected"; 
							echo "> $type_name </option> \n";
         			}
					mysql_close($dbname);
					?>
			      </select>

		  </td>
		</tr>

        <tr>
          <td class="bg_color"><div align="right">ที่ตั้ง : </div></td>
          <td class="yellow_bg_color">
		  		  <select name="edit_locationid" id="edit_locationid" width="30">
					<?php
						$sql3="select * from sbk_location  order by  id ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$location_id=$result3["id"];
							$location_name=$result3["name"];		
							echo   "<option value=\"$location_id\"  ";
							if($location_id==$edit_locationid) echo "selected"; 
							echo "> $location_name </option> \n";
         			}
					mysql_close($dbname);
					?>
			      </select>

		  </td>
		</tr>


        <tr>
          <td class="bg_color"><div align="right">สถานะการใช้งาน : </div></td>
		<td>
		<input name="group_status" type="radio" value="1" id="group_status" <? if($edit_group_status==1) echo "checked";?> > ใช้งาน 
        <input name="group_status" type="radio" value="2" id="group_status" <? if($edit_group_status==2) echo "checked";?>> ไม่ใช้งาน 
	
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
        <td class="bg_colorCopy"><img src="../images/report.gif" width="16" height="16" align="absmiddle" />หน่วยงานทั้งหมด </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="81%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="90">รหัสประเภท</td>
            <td width="206">ชื่อกลุ่ม/เครือข่าย</td>
            <td width="115">ประเภท</td>
            <td width="115">ที่ตั้ง</td>
           <td width="80">สถานะ </td>
            <td width="90">ดำเนินการ</td>
          </tr>
		  <?
		  		$sql="select * from sbk_group order by typeID desc,locationID ";
				$dbquery=mysql_db_query($dbname, $sql);
				
				while($result=mysql_fetch_array($dbquery))
				{
					$group_id=$result[id];
					$group_name=$result[name];
					$group_typeid=$result[typeID];
					$group_locationid=$result[locationID];
					$group_status=$result[status];

						$sql3="select * from sbk_location where id=$group_locationid ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$location_name=$result3["name"];		
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
						<td align='center'>$group_id</td>
						<td>&nbsp;$group_name</td>
						<td align='center'>&nbsp;$type_name</td>
						<td align='center'>&nbsp;$location_name</td>
						<td align='center'>&nbsp;$group_status</td>
						<td align='center'><a href='add_group.php?edit_group_id=$group_id' class='textnormal'>แก้ไข</a> | <a href='delete-function.php?del_group_id=$group_id' class='textnormal'>ลบ</a></td>
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
	if(document.form1.group_name.value == 0)
	{
		alert("กรุณาระบุชื่อกลุ่ม/เครือข่าย");
		document.form1.group_name.focus();
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
	if(document.form2.edit_group_name.value == 0)
	{
		alert("กรุณาระบุชื่อกลุ่ม/เครือข่าย");
		document.form2.edit_group_name.focus();
	}else
	document.form2.submit();
}

</script>
<? mysql_close(); 
}
?>