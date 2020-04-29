<? 
//Check if form submit with capt variable
if(!isset($_POST['capt'])) {
	//Form not submit return error
	echo"<meta http-equiv='refresh' content='2;URL=index.php'>";
	exit("Error  ไม่มีกิจห้ามเข้านะ");
}

//session must be start to perform check
session_start();
	error_reporting(E_ALL ^ E_NOTICE);

//check input capt with session captcha
if($_SESSION['captcha']!=$_POST['capt'] || $_SESSION['captcha']=='BADCODE')
    { 
     //wrong captcha exit the program not continue.
	echo"<meta http-equiv='refresh' content='2;URL=admin.php'>";
	 exit("คุณพิมพ์รหัสลับผิด กรุณากรอกให้ถูกต้อง");
	}
	
	$username=mysql_escape_string($_POST["username"]);
	$passwords=mysql_escape_string($_POST["passwords"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ตรวจสอบการล็อกอิน</title>
<link href="mystyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?
include('inc/connect_db.php');
?>
<?
	$sql="select * from  sbk_admin where username='$username' and password='$passwords'";
	//$dbname="of1";
	$dbquery = mysql_db_query($dbname, $sql);
	$num_rows = mysql_num_rows($dbquery);
	$i=0;
	while ($i < $num_rows)
	{
		$result = mysql_fetch_array($dbquery);
		$admin_name=$result[admin_name];
		$admin_id=$result[admin_id];
		$i++;
	}
	if($i==0)
	{?>
	
	<script language="javascript">
	alert("ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง กรุณาตรวจสอบ");
	window.location='admin.php';
	</script>
<?
	echo"<meta http-equiv='refresh' content='0;URL=index.php'>";
	}else{
	 	$sql="select * from  sbk_admin where username='$username' and password='$passwords'";
		//$dbname="of1";
		$dbquery = mysql_db_query($dbname, $sql);
		$num_rows = mysql_num_rows($dbquery);
		$i=0;
		while ($i < $num_rows)
		{
		$result = mysql_fetch_array($dbquery);
		$admin_name=$result[admin_name];
		$admin_id=$result[admin_id];
		$i++;
}	 	
		$_SESSION["admin_name"] = $admin_name; 
		$_SESSION["admin_id"] = $admin_id; 

		
//		session_register("admin_name");
//		session_register("admin_id");
		if($admin_name==$doc_central){
		echo"<meta http-equiv='refresh' content='0;URL=admin/main_saraban.php'>";
	}else{
		echo"<meta http-equiv='refresh' content='0;URL=admin/main.php'>";
		}
		}?>


</body>
</html>
<?
	mysql_close();
?>
