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
	
	$return_book_id=$_GET["return_book_id"];

	if($return_book_id){


//เช็คเลขสารบรรณ
	$sql_saraban="select id from sbk_organize  where name='สารบรรณกลาง' ";
	$dbquery_saraban=mysql_db_query($dbname, $sql_saraban);
	$result_saraban=mysql_fetch_array($dbquery_saraban);
	$id_saraban=$result_saraban[0];

	$sql="update sbk_sendbook set book_to='$id_saraban'  where id='$return_book_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	echo "<script language=\"javascript\">
	alert(\"ส่งหนังสือคืนสารบรรณกลางเรียบร้อยครับ\");
	window.location='doc_receive.php';
	</script>";
		}
	
}
?>