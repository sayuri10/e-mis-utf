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
if($room_id)
{
	$roomimg=$_FILES['roomimg'] ['tmp_name'];
	$roomimg_name=$_FILES['roomimg'] ['name'];
	$roomimg_size=$_FILES['roomimg'] ['size'];
	$roomimg_type=$_FILES['roomimg'] ['type'];
	
	if($chkdel=="1")
	{
		$sql="update meeting_room set roomimg=' ' where room_id='$room_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		unlink("roomimg/$del_roomimg");
	}
		
	if($roomimg)
	{
		$array_last=explode(".",$roomimg_name);
		$c=count($array_last) -1;
		$lastname=strtolower($array_last[$c]);
		if($lastname=="gif" or $lastname=="jpg" or $lastname=="jpeg")
		{
			$photoname=$room_id.".".$lastname;
			copy($roomimg, "roomimg/" .$photoname);
			
			$sql3="update meeting_room set roomimg='$photoname' where room_id='$room_id' ";
			$dbquery3=mysql_db_query($dbname, $sql3);
			unlink($roomimg);
		}
		else if($lastname<>"gif" or $lastname<>"jpg" or $lastname<>"jpeg")
		{
			echo "<script language=\"javascript\">
				alert(\"ไม่สามารถ upload ภาพได้เนื่องจาก ชนิดของภาพไม่ใช่ gif, jpg, jpeg กรุณาไปแก้ไข\");
				window.location='meetingroom.php?edit_room_id=$room_id';
			</script>";
		}
	}
	
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

	$sql2="update meeting_room set roomname='$roomname', roomplace='$roomplace', roomcount='$roomcount', dept='$dept', tel='$tel', comment='$comment' where room_id='$room_id' ";
	$dbquery2=mysql_db_query($dbname, $sql2);	
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='meetingroom.php';
</script>";
}

if($edit_toolname)
{
	$sql="update meeting_tools set toolname='$edit_toolname' where tool_id='$tool_id' ";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='toolmeeting.php';
</script>";
}

if($conf_book_id)
{
	$sql2="select * from meeting_booking where startdate='$startdate' AND starttime='$starttime' AND endtime='$endtime' AND room_id='$sel_room_id' AND conf_status='1' ";
	$dbquery2=mysql_db_query($dbname,$sql2);
	$numrows=mysql_num_rows($dbquery2);
	if($numrows > 0)
	{
		echo "<script language=\"javascript\">
	alert(\"ห้องนี้คุณได้อนุมัติการใช้งานในวันและเวลาที่เลือกแล้วครับ\");
	window.location='meeting-data.php';
</script>";
	}else if($numrows == '0')
	{
	
	$sql="update meeting_booking set conf_status='1' where book_id='$conf_book_id' ";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"อนุมัติเรียบร้อยครับ\");
	window.location='meeting-data-conf.php';
</script>";
	}
}
/*
if($old_pass and $new_pass1 and $new_pass2)
{
	$sql="select * from meeting_admin";
	$dbquery=mysql_db_query($dbname, $sql);
	$result=mysql_fetch_array($dbquery);
	
	$passwords=$result[passwords];
	
	if($old_pass <> $passwords)
	{
			echo "<script language=\"javascript\">
	alert(\"รหัสเดิมไม่ถูกต้อง\");
	window.location='changepass.php';
</script>";
	}else if($old_pass == $passwords)
	{
		if($new_pass1 == $new_pass2)
		{
			$sql2="update meeting_admin set passwords='$new_pass1' ";
			$dbquery2=mysql_db_query($dbname, $sql2);
		}else if($new_pass1 <> $new_pass2)
		{
						echo "<script language=\"javascript\">
	alert(\"รหัสที่พิมพ์ไม่ตรงกัน\");
	window.location='changepass.php';
</script>";
		}
	}
							echo "<script language=\"javascript\">
	alert(\"เปลี่ยนรหัสผ่านเรียบร้อยครับ\");
	window.location='changepass.php';
</script>";
}
*/

if($edit_fullname)
{
	$sql="update meeting_user set name='$edit_fullname', department='$edit_dept', username='$edit_account', passwords='$edit_pass', phone='$phone' where user_id=$edit_user_id ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_user.php';
</script>";
}

if($edit_dept_id)
{
	$sql="update meeting_department set dept_name='$edit_dept_name', dept_code='$edit_dept_code' where dept_id='$edit_dept_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_dept.php';
</script>";
}


if($edit_starttime_id)
{
	$sql="update meeting_starttime set time_name='$starttime' where time_id='$edit_starttime_id' ";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='savetime.php';
</script>";
}

if($edit_endtime_id)
{
	$sql="update meeting_endtime set time_name='$endtime' where time_id='$edit_endtime_id' ";
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='savetime.php';
</script>";
}

if($book_id)
{
	$sql="select * from meeting_booking where book_id='$book_id' ";
	$dbquery=mysql_db_query($dbname, $sql);
	$result=mysql_fetch_array($dbquery);

		$subject=$result[subject];
		$head=$result[head];
		$num=$result[numpeople];
		$room_id=$result[room_id];
		$startdate=$result[startdate];
		$starttime=$result[starttime];
		$endtime=$result[endtime];
		$bookname=$result[bookname];
		$bookingdate=$result[bookingdate];
		$user_id=$result[user_id];
		$conf_status=$result[conf_status];
		$comment=$result[comment];

		$today=date("Y-m-d");

		$sql2="insert into meeting_booking_ori(count_id, book_id, subject, head, numpeople, room_id, startdate, starttime, endtime, bookname, bookingdate, user_id, comment, conf_status, date_edit)
		values('', '$book_id', '$subject', '$head', '$num', '$room_id', '$startdate', '$starttime', '$endtime', '$bookname', '$bookingdate', '$user_id', '$comment', '$conf_status', '$today' )";
		//echo $sql2;
		$dbquery2=mysql_db_query($dbname, $sql2);

		$sql33="update meeting_booking set update_status='0' where book_id='$book_id'";
		$dbquery33=mysql_db_query($dbname, $sql33);
	echo "<script language=\"javascript\">
	alert(\"บันทึกรับทราบ\");
	window.location='meeting-data-conf.php';
</script>";
}

//แก้ไขประเภท
if($_POST["edit_type_id"])
{	
	$edit_type_id=$_POST["edit_type_id"];
	$edit_type_name=$_POST["edit_type_name"];
	$edit_type_level=$_POST["edit_type_level"];
	$type_status=$_POST["type_status"];

	$sql="update sbk_type set name='$edit_type_name' ,level='$edit_type_level' ,status='$type_status' where id='$edit_type_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_type.php';
</script>";
}

//แก้ไขที่ตั้งหน่วยงาน
if($_POST["edit_location_id"])
{	
	$edit_location_id=$_POST["edit_location_id"];
	$edit_location_name=$_POST["edit_location_name"];
	$location_status=$_POST["location_status"];

	$sql="update sbk_location set name='$edit_location_name' ,status='$location_status' where id='$edit_location_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_location.php';
</script>";
}

//แก้ไขกลุ่มหน่วยงาน
if($_POST["edit_group_id"])
{	
	$edit_group_id=$_POST["edit_group_id"];
	$edit_group_name=$_POST["edit_group_name"];
	$edit_typeid=$_POST["edit_typeid"];
	$edit_locationid=$_POST["edit_locationid"];
	$group_status=$_POST["group_status"];

	$sql="update sbk_group set name='$edit_group_name' ,typeID='$edit_typeid' ,locationID='$edit_locationid' ,status='$group_status' where id='$edit_group_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_group.php';
</script>";
}

//แก้ไขหน่วยงาน
if($_POST["edit_organize_id"])
{	
	$edit_organize_id=$_POST["edit_organize_id"];
	$edit_organize_name=$_POST["edit_organize_name"];
	$edit_organize_numbook=$_POST["edit_organize_numbook"];
	$edit_organize_smis=$_POST["edit_organize_smis"];
	$edit_groupid=$_POST["edit_groupid"];
	$edit_organize_thumbol=$_POST["edit_organize_thumbol"];
	$edit_organize_email=$_POST["edit_organize_email"];
	$edit_organize_telephone=$_POST["edit_organize_telephone"];
	$organize_status=$_POST["organize_status"];

//	list($edit_groupid1,$edit_typeid) = split(",",$edit_groupid);

	$sql="update sbk_organize set name='$edit_organize_name' ,num_book='$edit_organize_numbook' ,smis='$edit_organize_smis' ,groupID='$edit_groupid' ,thumbol='$edit_organize_thumbol' 
			, email='$edit_organize_email' , telephone='$edit_organize_telephone' ,status='$organize_status' where id='$edit_organize_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_organize.php';
</script>";
}

//แก้ไขบัญชีผู้ใช้งาน
if($_POST["edit_user_id"])
{	
	$edit_user_id=$_POST["edit_user_id"];
	$edit_username=$_POST["edit_username"];
	$edit_password=$_POST["edit_password"];
	$edit_organize=$_POST["edit_organize"];
	$user_status=$_POST["user_status"];

//	list($edit_groupid1,$edit_typeid) = split(",",$edit_groupid);

	$sql="update sbk_user set username='$edit_username' ,password='$edit_password' ,organizeID='$edit_organize' ,status='$user_status' where user_id='$edit_user_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_user.php';
</script>";
}

//เปลี่ยนรหัสผ่าน
if($_POST["old_pass"] and $_POST["new_pass1"] and $_POST["new_pass2"])
{
	$old_pass=$_POST["old_pass"];
	$new_pass1=$_POST["new_pass1"];
	$new_pass2=$_POST["new_pass2"];
	$admin_id=$_POST["admin_id"];
		
	$sql="select * from sbk_admin where admin_id=$admin_id ";
	$dbquery=mysql_db_query($dbname, $sql);
	$result=mysql_fetch_array($dbquery);
	
	$passwords=$result[password];
	
	if($old_pass <> $passwords)
	{
			echo "<script language=\"javascript\">
	alert(\"รหัสเดิมไม่ถูกต้อง\");
	window.location='changepass.php';
</script>";
	}else if($old_pass == $passwords)
	{
		if($new_pass1 == $new_pass2)
		{
			$sql2="update sbk_admin set password='$new_pass1' where admin_id=$admin_id  ";
			$dbquery2=mysql_db_query($dbname, $sql2);
		}else if($new_pass1 <> $new_pass2)
		{
						echo "<script language=\"javascript\">
	alert(\"รหัสที่พิมพ์ไม่ตรงกัน\");
	window.location='changepass.php';
</script>";
		}
	}
							echo "<script language=\"javascript\">
	alert(\"เปลี่ยนรหัสผ่านเรียบร้อยครับ\");
	window.location='body.php';
</script>";
}

//แก้ไขบัญชีผู้ผู้ดูแลระบบ
if($_POST["edit_admin_id"])
{	
	$edit_user_id=$_POST["edit_admin_id"];
	$edit_username=$_POST["edit_username"];
	$edit_password=$_POST["edit_password"];
	$edit_organize=$_POST["edit_name"];
	$user_status=$_POST["user_status"];

//	list($edit_groupid1,$edit_typeid) = split(",",$edit_groupid);

	$sql="update sbk_admin set username='$edit_username' ,password='$edit_password' ,admin_name='$edit_name' ,status='$user_status' where admin_id='$edit_user_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"แก้ไขเรียบร้อยครับ\");
	window.location='add_admin.php';
</script>";
}



mysql_close();
?>

</body>
</html>
<? } ?>