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
	if($del_room_id)
	{
		$sql="delete from meeting_room where room_id='$del_room_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		unlink("roomimg/$del_roomimg");
		echo"<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='meetingroom.php';
		</script>";
	}
	
	if($del_tool_id)
	{
		$sql="delete from meeting_tools where tool_id='$del_tool_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo"<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='toolmeeting.php';
		</script>";
	}
	
	if($conf_book_id)
	{
		$sql="update meeting_booking set conf_status='2' where book_id='$conf_book_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ไม่อนุมัติเรียบร้อยครับ\");
		window.location='meeting-data-cancel.php';
	</script>";
	}
	
	if($del_user_id)
	{
		$sql="delete from meeting_user where user_id='$del_user_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบผู้ใช้เรียบร้อยครับ\");
		window.location='add_user.php';
	</script>";
	}
	
	if($del_dept_id)
	{
		$sql="delete from meeting_department where dept_id='$del_dept_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_dept.php';
	</script>";
	}
	
	if($del_starttime_id)
	{
		$sql="delete from meeting_starttime where time_id='$del_starttime_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='savetime.php';
	</script>";
	}

	if($del_endtime_id)
	{
		$sql="delete from meeting_endtime where time_id='$del_endtime_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='savetime.php';
	</script>";
	}
	
	if($room_id and $tool_id)
	{
		$sql="delete from meeting_roomtools where room_id='$room_id' AND tool_id='$tool_id' ";
		//echo $sql;
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='viewtools.php?room_id=$room_id';
	</script>";
	}

	if($del_tools_id2 and $del_room_id2 and $edit_room_id)
	{
		$sql="delete from meeting_roomtools where room_id='$del_room_id2' AND tools_id='$del_tools_id2'";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='meetingroom.php?edit_room_id=$edit_room_id';
	</script>";
	}

	if($del_book_id)
	{
		$sql="delete from meeting_booking where book_id='$del_book_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ยกเลิกเรียบร้อยครับ\");
		window.location='meeting-data-conf.php';
	</script>";
	}

//ลบประเภทหน่วยงาน
	$del_type_id=$_GET["del_type_id"];
	if($del_type_id)
	{
		$sql="delete from sbk_type where id='$del_type_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_type.php';
	</script>";
	}

//ลบที่ตั้งหน่วยงาน
	$del_location_id=$_GET["del_location_id"];
	if($del_location_id)
	{
		$sql="delete from sbk_location where id='$del_location_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_location.php';
	</script>";
	}

//ลบกลุ่มของหน่วยงาน
	$del_group_id=$_GET["del_group_id"];
	if($del_group_id)
	{
		$sql="delete from sbk_group where id='$del_group_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_group.php';
	</script>";
	}

//ลบหน่วยงาน
	$del_organize_id=$_GET["del_organize_id"];
	if($del_organize_id)
	{	
		$sql="delete from sbk_organize where id='$del_organize_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_organize.php';
	</script>";
	}

//ลบบัญชีผู้ใช้งาน
	$del_user_id=$_GET["del_user_id"];
	if($del_user_id)
	{	
		$sql="delete from sbk_user where user_id='$del_user_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_user.php';
	</script>";
	}

//ลบบัญชีผู้ดูแลระบบ
	$del_admin_id=$_GET["del_admin_id"];
	if($del_admin_id)
	{	
		$sql="delete from sbk_admin where admin_id='$del_admin_id' ";
		$dbquery=mysql_db_query($dbname, $sql);
		echo "<script language=\"javascript\">
		alert(\"ลบเรียบร้อยครับ\");
		window.location='add_admin.php';
	</script>";
	}

?>

</body>
</html>
<? } ?>