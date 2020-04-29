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
	
//ยกเลิกหนังสือ
	$edit_booktoarea_id=$_GET["edit_booktoarea_id"];
	if($edit_booktoarea_id){

	$sql="update sbk_book set status='0'  where id='$cancel_book_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);

	$sql2="update sbk_sendbook set status='0'  where bookID='$cancel_book_id'  ";
			$db_query2=mysql_db_query($dbname,$sql2) or die(mysql_error()."by command".$sql2);

	echo "<script language=\"javascript\">
	alert(\"ยกเลิกเรียบร้อยครับ\");
	window.location='doc_all_send.php';
	</script>";
		}


}
?>