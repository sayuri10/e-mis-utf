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
</head>
<body>
<?
if($add_room)
{
	$roomimg=$_FILES['roomimg'] ['tmp_name'];
	$roomimg_name=$_FILES['roomimg'] ['name'];
	$roomimg_size=$_FILES['roomimg'] ['size'];
	$roomimg_type=$_FILES['roomimg'] ['type'];
	
		$array_last=explode(".", $roomimg_name);
		$c=count($array_last)-1;
		$lastname=strtolower($array_last[$c]);
		
		if($lastname=="gif" or $lastname=="jpg" or $lastname=="jpeg")
		{
			$sql="insert into meeting_room(room_id, roomname, roomplace, roomcount, dept, tel, comment)
			values('', '$roomname', '$roomplace', '$roomcount', '$dept', '$tel', '$comment')";
			$dbquery=mysql_db_query($dbname, $sql);
			
			$sql2="select max(room_id) from meeting_room";
			$dbquery2=mysql_db_query($dbname, $sql2);
			$result=mysql_fetch_array($dbquery2);
			
			$room_id=$result[0];
			
			$filename=$room_id .".".$lastname;
			
			copy($roomimg, "roomimg/" .$filename);
			
			$sql3="update meeting_room set roomimg='$filename' where room_id='$room_id' ";
			//echo $sql3;
			$dbquery3=mysql_db_query($dbname, $sql3);
			unlink($roomimg);		
			
			if($checktool)
			{
				for ($i=0;$i<count($checktool);$i++) 
				{ 
					$tool_id= $checktool[$i];
				
					$sql23="insert into meeting_roomtools(room_id, tools_id) values('$room_id', '$tool_id') "; 
					//echo $sql2;
					$dbquery23=mysql_db_query($dbname,$sql23); 	
				}
			}
			echo "<script language='javascript'>
				alert('บันทึกข้อมูลเรียบร้อยครับ');
				window.location='meetingroom.php';
			</script>";
						
		}else if($lastname<>"gif" or $lastname<>"jpg" or $lastname<>"jpeg")
		{
			echo "<script language='javascript'>
				alert('ไม่สามารถ upload ภาพได้เนื่องจาก ชนิดไฟล์ไม่ถูกต้อง ต้องเป็นชนิด gif, jpg, jpeg เท่านั้น');
				window.location='meetingroom.php';
			</script>";
		}
}

if($add_tools)
{
	$sql="insert into meeting_tools(tool_id, toolname) values('', '$toolname')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='toolmeeting.php';
	</script>";		
}

if($starttime)
{
	$sql="insert into meeting_starttime(time_id, time_name) values('', '$starttime')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='savetime.php';
	</script>";
}

if($endtime)
{
	$sql="insert into meeting_endtime(time_id, time_name) values('', '$endtime')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='savetime.php';
	</script>";
}

if($account)
{
	/*
	$sql2="select * from meeting_user where username='$account'";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('ชื่อผู้ใช้ซ้ำครับ');
		window.location='add_user.php';
		</script>";
	}else if($numrows == 0)
	{
		$sql="insert into meeting_user(user_id, username, passwords, name, department) values('', '$account', '$pass', '$fullname', '$dept')";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language='javascript'>
		alert('บันทึกข้อมูลเรียบร้อยครับ');
		window.location='add_user.php';
		</script>";
	}
	*/
	$sql2="select * from sbk_user where username='$username'";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('ชื่อผู้ใช้ซ้ำครับ');
		window.location='add_user.php';
		</script>";
	}else if($numrows == 0)
	{
		$sql="insert into sbk_user(user_id, username, password, organizeID,count_login,last_login,status,) values('', '$username', '$password', '$organize','','','$status')";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language='javascript'>
		alert('บันทึกข้อมูลเรียบร้อยครับ');
		window.location='add_user.php';
		</script>";
	}


}

if($dept_name)
{
	$sql2="select * from meeting_department where dept_code='$dept_code'";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('รหัสหน่วยงานซ้ำครับ');
		window.location='add_dept.php';
		</script>";
	}else if($numrows == 0)
	{
	$sql="insert into meeting_department(dept_code, dept_name) values('$dept_code', '$dept_name')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='add_dept.php';
	</script>";
	}
}

if($checktool)
{				
	for ($i=0;$i<count($checktool);$i++) 
		{ 
			$tool_id= $checktool[$i];
					
			$sql4="insert into meeting_roomtools(room_id, tool_id) values('$room_id', '$tool_id') "; 
			//echo $sql4;
			$dbquery4=mysql_db_query($dbname,$sql4); 	
		}
		
		echo "<script language='javascript'>
		alert('บันทึกข้อมูลเรียบร้อยครับ');
		window.location='viewtools.php?room_id=$room_id';
		</script>";
}

//เพิ่มประเภทหน่วยงาน
if($_POST["type_name"])
{	
	$type_name=$_POST["type_name"];
	$type_level=$_POST["type_level"];
	$type_status=$_POST["type_status"];
	
	$sql2="select * from sbk_type where name='$type_name' ";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('รหัสหน่วยงานซ้ำครับ');
		window.location='add_type.php';
		</script>";
	}else if($numrows == 0)
	{
	$sql="insert into sbk_type(id, name, level, status) values( '', '$type_name', '$type_level', '$type_status')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='add_type.php';
	</script>";
	}
}

//เพิ่มที่ตั้งหน่วยงาน
if($_POST["location_name"])
{	
	$location_name=$_POST["location_name"];
	$location_status=$_POST["location_status"];

	$sql2="select * from sbk_location where name='$location_name' ";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('รหัสหน่วยงานซ้ำครับ');
		window.location='add_location.php';
		</script>";
	}else if($numrows == 0)
	{
	$sql="insert into sbk_location(id, name, status) values( '', '$location_name', '$location_status')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='add_location.php';
	</script>";
	}
}

//เพิ่มกลุ่มของหน่วยงาน
if($_POST["group_name"])
{	
	$group_name=$_POST["group_name"];
	$typeid=$_POST["typeid"];
	$locationid=$_POST["locationid"];
	$group_status=$_POST["group_status"];
	
	$sql2="select * from sbk_group where name='$group_name' ";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('รหัสหน่วยงานซ้ำครับ');
		window.location='add_group.php';
		</script>";
	}else if($numrows == 0)
	{
	$sql="insert into sbk_group(id, name, typeID, locationID, status) values( '', '$group_name', '$typeid', '$locationid', '$group_status')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='add_group.php';
	</script>";
	}
}

//เพิ่มหน่วยงาน
if($_POST["organize_name"])
{	
	$organize_name=$_POST["organize_name"];
	$organize_numbook=$_POST["organize_numbook"];
	$organize_smis=$_POST["organize_smis"];
	$groupid=$_POST["groupid"];
	$organize_thumbol=$_POST["organize_thumbol"];
	$organize_email=$_POST["organize_email"];
	$organize_telephone=$_POST["organize_telephone"];
	$organize_status=$_POST["organize_status"];

	$sql2="select * from sbk_organize where name='$organize_name' ";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('รหัสหน่วยงานซ้ำครับ');
		window.location='add_organize.php';
		</script>";
	}else if($numrows == 0)
	{
	$sql="insert into sbk_organize(id, name, num_book, smis, groupID, thumbol, email, telephone, status) values( '', '$organize_name','$organize_numbook' 
			, '$organize_smis' ,'$groupid' ,'$organize_thumbol','$organize_email', '$organize_telephone', '$organize_status')";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language='javascript'>
	alert('บันทึกข้อมูลเรียบร้อยครับ');
	window.location='add_organize.php';
	</script>";
	}
}

//แก้ไขบัญชีผู้ใช้งาน
if($_POST["user_username"])
{	
	$user_username=$_POST["user_username"];
	$user_password=$_POST["user_password"];
	$user_organize=$_POST["user_organize"];
	$user_status=$_POST["user_status"];

	$sql2="select * from sbk_user where username='$user_username' ";
	$dbquery2=mysql_db_query($dbname, $sql2);
	$numrows=mysql_num_rows($dbquery2);
	
	if($numrows <> 0)
	{
		echo "<script language='javascript'>
		alert('ชื่อผู้ใช้ซ้ำครับ');
		window.location='add_user.php';
		</script>";
	}else if($numrows == 0)
	{
		$sql="insert into sbk_user(user_id, username, password, organizeID,count_login,last_login,status) values( '' , '$user_username', '$user_password', '$user_organize','','','$user_status')";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language='javascript'>
		alert('บันทึกข้อมูลเรียบร้อยครับ');
		window.location='add_user.php';
		</script>";
	}
}


mysql_close();
?>

</body>
</html>
<? } ?>