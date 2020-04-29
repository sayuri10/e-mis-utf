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
	
	$register_book_id=$_GET["register_book_id"];

	if($register_book_id){

//เช็ควันที่ส่งหนังสือ  หรือ ใช้ NOW()
	$today_date = date("Y-m-d");



//เช็คลำดับหนังสือออก
	$sql3="select max(receive) from sbk_sendbook where book_to='$userorganize_id'";
	$dbquery3=mysql_db_query($dbname, $sql3);
	$result3=mysql_fetch_array($dbquery3);
	$book_receive_num=$result3[0]+1;


	$sql="update sbk_sendbook set receive='$book_receive_num' , date_receive='$today_date'  where id='$register_book_id' ";
	//echo $sql;
	$dbquery=mysql_db_query($dbname, $sql);
	include 'makename.php';
	echo "<script language=\"javascript\">
	alert(\"ลงทะเบียนรับเรียบร้อยครับ\");
	window.location='doc_receive.php';
	</script>";
		}
	
}
?>