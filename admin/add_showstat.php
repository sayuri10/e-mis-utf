<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=../index.php'>";
			exit(); 
} else {
		
		$admin_name=$_SESSION["admin_name"];
		$admin_id=$_SESSION["admin_id"];
	include '../inc/connect_db.php';
	

//ลบสถิติเก่าก่อนนะ
		$sql="delete from sbk_showstat ";
		$dbquery=mysql_db_query($dbname, $sql);

//กลุ่มเครือข่าย
		$sql1="SELECT * FROM sbk_group  WHERE (status=1)  order by typeID desc ,id";
		$query1=mysql_db_query($dbname, $sql1) or die(mysql_error()."by command".$sql1);
			while($result1=mysql_fetch_array($query1)){
			$group_name=$result1["name"];

//อำเภอ
			$sql6="select name FROM sbk_location  WHERE (status=1)  and  (id='".$result1["locationID"]."')  ";
			$dbquery6=mysql_db_query($dbname, $sql6);
			$result6=mysql_fetch_array($dbquery6);
			$location_name=$result6[0];

//ชื่อหน่วยงาน
	$sql2="SELECT * FROM sbk_organize  WHERE (status=1)  and (groupID= '".$result1["id"]."')  ";
	$query2=mysql_db_query($dbname, $sql2) or die(mysql_error()."by command".$sql2);
	while($result2=mysql_fetch_array($query2)){
		$sum_count_login=0;
		$organize_name=$result2["name"];
		$organize_smis=$result2["smis"];
		$organize_id=$result2["id"];
		
//จำนวน Login
		$sql3="SELECT * FROM sbk_user  WHERE (status=1) and (organizeID = '".$result2["id"]."')  ";
		$query3=mysql_db_query($dbname, $sql3) or die(mysql_error()."by command".$sql3);
		while($result3=mysql_fetch_array($query3)){
					$sum_count_login=$sum_count_login+$result3["count_login"];
				}

//จำนวนส่งหนังสือ
			$sql4="select max(send_num) from sbk_book where book_from='".$result2["id"]."' ";
			$dbquery4=mysql_db_query($dbname, $sql4);
			$result4=mysql_fetch_array($dbquery4);
			$book_send_num=$result4[0];

//จำนวนรับหนังสือ				
			$sql5="select max(receive) from sbk_sendbook where book_to='".$result2["id"]."' and receive<>0 ";
			$dbquery5=mysql_db_query($dbname, $sql5);
			$result5=mysql_fetch_array($dbquery5);
			$book_receive_num=$result5[0];

	//วันที่
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;


//สร้างฐานข้อมูล			
			$sql7="insert into sbk_showstat (id, smis, schoolname,groupname,aumphur, numlogin, numsend, numreceive , statdate ,status) values('$organize_id', '$organize_smis', '$organize_name', '$group_name' , '$location_name', '$sum_count_login', '$book_send_num', '$book_receive_num' , '$showtodaydate','')";
			$dbquery7=mysql_db_query($dbname, $sql7) or die(mysql_error()." by command ".$sql7);

//ทดสอบ Error
//echo "$sql7 <br>$group_name <br>$location_name<br>$organize_name<br>$organize_id<br>$organize_smis<br>$sum_count_login<br>$book_send_num<br>$book_receive_num<br><br><br>  ";

			}   //จบสร้างหน่วยงาน
		
			}   //จบสร้างกลุ่ม



		echo "<script language=\"javascript\">
		alert(\"สร้างข้อมูลตารางเรียบร้อยครับ\");
		window.location='body.php';
	</script>";

}  //จบเช็ค ADMIN