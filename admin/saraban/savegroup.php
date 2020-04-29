<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
			echo"<meta http-equiv='refresh' content='0;URL=../../index.php'>";
			exit(); 
} else {
?>

<html>
<head>
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
</head>
<body>
<?
	include '../../inc/connect_db.php';
	
	$frm_bookid=$_GET["SaveBID"];
	$frm_organid=$_POST["organize"];

	$sql="update sbk_sendbook set book_to='$frm_organid'  where id='$frm_bookid' ";
	$dbquery=mysql_db_query($dbname, $sql) or die(mysql_error()."by command".$sql);
	echo "บันทึกข้อมูลเรียบร้อยครับ";
	
	mysql_close();
	
	include 'makename.php';

?>

</body>
</html>

<?
}
?>