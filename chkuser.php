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
	echo"<meta http-equiv='refresh' content='2;URL=index.php'>";
	 exit("คุณพิมพ์รหัสลับผิด กรุณากรอกให้ถูกต้อง");
	}



	$username=$_POST["username"];
	$passwords=$_POST["passwords"];
	$username=mysql_escape_string($username);
	$passwords=mysql_escape_string($passwords);

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
	$sql="select * from  sbk_user where username='$username' and password='$passwords' ";
//	$dbname="of1";
	$dbquery = mysql_db_query($dbname, $sql);
	$num_rows = mysql_num_rows($dbquery);
	$i=0;
	while ($i < $num_rows)
	{
		$result = mysql_fetch_array($dbquery);
		$username2=$result[username];
		$username_id=$result[user_id];
		$organize_id=$result[organizeID];
		$i++;
	}
	if($i==0)
	{  
	?>
		
	<script language="javascript">
	alert("ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง กรุณาตรวจสอบ");
	location.href("index.php");
	</script>
	
<?
	echo"<meta http-equiv='refresh' content='0;URL=index.php'>";

	}else{
	 	$sql="select * from  sbk_user where username='$username' and password='$passwords' ";
//		$dbname="meeting";
		$dbquery = mysql_db_query($dbname, $sql);
		$num_rows = mysql_num_rows($dbquery);
		$i=0;
		while ($i < $num_rows)
		{
		$result = mysql_fetch_array($dbquery);
		$username2=$result[username];
		$username_id=$result[user_id];
		$userorganize_id=$result[organizeID];
		$current_count_login=$result[count_login];
		$i++;
}	 		
		$_SESSION["username2"] = $username2; 
		$_SESSION["username_id"] = $username_id; 
		$_SESSION["userorganize_id"] = $userorganize_id; 

		$update_count_login=$current_count_login+1;

			$sql2="update sbk_user set count_login =$update_count_login where user_id=$username_id  ";
			$dbquery2=mysql_db_query($dbname, $sql2) or die(mysql_error()."Error  by command".$sql2); 
	
					$start=date("Y-m-d H:i:s");
					$get_ip=$_SERVER['REMOTE_ADDR'];
			$sql9="select * from  sbk_userlogs where username='$username_id' ";
			$db_query9=mysql_db_query($dbname,$sql9) or die(mysql_error()."Error Insert sbk_sendbook by command".$sql9); ;
			$num_rows_user = mysql_num_rows($db_query9);
					if($num_rows_user<$num_logs){
							$iSQL="insert into sbk_userlogs(username,num_user,timeStart,ip_addr) values('".$username_id."','','".$start."','".$get_ip."')";
							$iResult=mysql_query($iSQL) or die("Query Fail by".mysql_error()." [".$logSQL."]");
					}else{
							$sql7="select min(timeStart) from  sbk_userlogs where username='$username_id' ";
							$db_query7=mysql_db_query($dbname,$sql7) or die(mysql_error()."Error Insert sbk_sendbook by command".$sql7); ;
							while($result7 = mysql_fetch_array($db_query7))
								{
										$mintime=$result7[0];
								}
						
						$sql8="update sbk_userlogs set  timeStart='$start' ,ip_addr ='".$get_ip."' where username='$username_id' and timeStart='$mintime' ";
						$dbquery8=mysql_db_query($dbname, $sql8) or die(mysql_error()."Error  by command".$sql8); 

							
							}

//		session_register("username2");
//		session_register("username_id");
//		session_register("userorganize_id");

		echo"<meta http-equiv='refresh' content='0;URL=main.php'>";
	 	}?>


</body>
</html>
<?
	mysql_close();
?>