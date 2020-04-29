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
	
	
	//เปลี่ยนรหัสผ่าน
if($_POST["old_pass"] and $_POST["new_pass1"] and $_POST["new_pass2"])
{
	$old_pass=$_POST["old_pass"];
	$new_pass1=$_POST["new_pass1"];
	$new_pass2=$_POST["new_pass2"];
	$username_id=$_POST["username_id"];
		
	$sql="select * from sbk_user where user_id=$username_id ";
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
			$sql2="update sbk_user set password='$new_pass1' where user_id=$username_id  ";
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
	window.location='doc_receive.php';
</script>";
}

	//เปลี่ยนข้อมูลพื้นฐาน
if($_POST["name_org"])
{
	$thumbol_org=$_POST["thumbol_org"];
	$email_org=$_POST["email_org"];
	$tel_org=$_POST["tel_org"];
	$web_org=$_POST["web_org"];
	$director_org=$_POST["director_org"];
	$tel_director=$_POST["tel_director"];
	$userorganize_id=$_POST["userorganize_id"];
	$name_org=$_POST["name_org"];

		
			$sql2="update sbk_organize set thumbol='$thumbol_org' , email='$email_org' , telephone='$tel_org' , website='$web_org' , director='$director_org' , teldirector='$tel_director'  where id=$userorganize_id ";
			$dbquery2=mysql_db_query($dbname, $sql2);

	//echo $sql2;
	echo "<script language=\"javascript\">
		alert(\"แก้ไขข้อมูลเรียบร้อยครับ\");
		window.location='doc_receive.php';
		</script>";
}



}
?>