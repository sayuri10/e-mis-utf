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
	
	//วันที่
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;


	
//เพิ่มรายละเอียดหนังสือ
	if(isset($_POST['organize'])){
		
	//	$frm_date_post=$_POST['date_post'];
		$frm_send_num=$_POST['send_num'];
		$frm_priority=$_POST['priority'];
		$frm_doc_num=$_POST['doc_num'];
		$frm_date_doc=$_POST['date_doc'];
		$frm_title=$_POST['titlesubject'];
		$frm_detail=$_POST['detail'];
		$frm_from=$_POST['sendfrom'];


//จบเพิ่มรายละเอียดหนังสือ

//แยกวันที่ บันทึกลง database
	
	$arrdate= explode("-", $frm_date_doc);
	$date_doc_day = $arrdate[0]; // one
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // tree
	$date_doc_send=$date_doc_year."-".$date_doc_month."-".$date_doc_day;

//เช็ควันที่ส่งหนังสือ  หรือ ใช้ NOW()
	$today_date = date("Y-m-d");

//เช็คลำดับหนังสือออก
	$sql3="select max(send_num) from sbk_book  where book_from='$frm_from'";
	$dbquery3=mysql_db_query($dbname, $sql3);
	$result3=mysql_fetch_array($dbquery3);
	$book_send_num=$result3[0]+1;

//เลือกประเภท
		  		$sql="select * from sbk_organize where  id='$frm_from'  ";
				$dbquery=mysql_db_query($dbname, $sql);
				
				while($result=mysql_fetch_array($dbquery))
				{
					$fromorganize_groupid=$result["groupID"];
					$fromorganize_name=$result["name"];

						$sql2="select * from sbk_group where id=$fromorganize_groupid ";
						$db_query2=mysql_db_query($dbname,$sql2);
					while($result2 = mysql_fetch_array($db_query2))
					{
							$fromgroup_typeid=$result2["typeID"];
					}
				}

		//ส่งชื่อหนังสือลง database	
			$sql5="insert into sbk_book ( id , priority , doc_num , book_title , date_doc , book_from , from_type , to_type , detail , date_post , year , send_num , respond , file1 , file2 , file3 , file4 , file5 , status ) 
			values( '' , '$frm_priority' , '$frm_doc_num' , '$frm_title' , '$date_doc_send' , '$frm_from' , '$fromgroup_typeid' , '1' , '$frm_detail' , '$today_date' , '$arrdate[2]' , '$book_send_num' , '' , 'file1' , 'file2' , 'file3' , 'file4' , 'file5' , '1' )";
			$db_query5=mysql_db_query($dbname, $sql5) or die(mysql_error()."Error Insert sbk_book by command".$sql5); 

	$sql7="select max(id) from sbk_book where send_num='$book_send_num' and book_from='$frm_from' ";
	$dbquery7=mysql_db_query($dbname, $sql7);
	$result7=mysql_fetch_array($dbquery7);
	$book_sended_id=$result7[0];

/*
	$sql8="select year from sbk_book where id='$book_sended_id'";
	$dbquery8=mysql_db_query($dbname, $sql8);
	$result8=mysql_fetch_array($dbquery8);
	$book_send_year=$result8["year"];
*/
//เพิ่มหน่วยงานที่ส่ง
for($i=0;$i<count($_POST['organize']);$i++)
{
			$toorganize=$_POST['organize'][$i];
			//หาค่า max document ของแต่ละหน่วยงาน

			$sqlselectgroup="select * from sbk_organize where  id='$toorganize'";
			$db_query3=mysql_db_query($dbname,$sqlselectgroup);
			$result3 = mysql_fetch_array($db_query3);
			$toorganize_groupid=$result3[groupID];
				$sql4="select * from sbk_group where id=$toorganize_groupid ";
				$db_query4=mysql_db_query($dbname,$sql4);
					while($result4 = mysql_fetch_array($db_query4))
					{
							$togroup_typeid=$result4["typeID"];
					}

//ส่งเช้าแต่ละหน่วยงาน
			$sql6="insert into sbk_sendbook ( id , bookID , book_from , book_to , receive , year , date_receive , status ) 
			values( '' , '$book_sended_id' , '$frm_from' , '$toorganize' , '' , '$arrdate[2]' , '' , '1'  )";
			$db_query6=mysql_db_query($dbname, $sql6) or die(mysql_error()."Error Insert sbk_sendbook by command".$sql6); 





}
//จบเพิ่มหน่วยงาน

//เพิ่มไฟล์แนบเข้า database
					$upfile1='';
					$upfile2='';
					$upfile3='';
					$upfile4='';
					$upfile5='';
	
			$sql_file="select * from sbk_tmp_upload where  qid='".$username2."' and up1=1 ";
			$db_query_file=mysql_db_query($dbname,$sql_file) or die(mysql_error()."Error select picture by command".$sql_file); 
//			$result_file = mysql_fetch_array($db_query_file);
			while($result_file=mysql_fetch_array($db_query_file)){
				
				$namefile=$result_file["date_upload"]."/".$result_file["name"];
				$fileupload=$result_file["up1"];
				$userupload=$result_file["qid"];
				if($fileupload==1) {
					$upfile1=$namefile;
				}else { $upfile1 = ''; }
			}
			$sql_file="select * from sbk_tmp_upload where  qid='".$username2."' and up1=2 ";
			$db_query_file=mysql_db_query($dbname,$sql_file) or die(mysql_error()."Error select picture by command".$sql_file); 
//			$result_file = mysql_fetch_array($db_query_file);
			while($result_file=mysql_fetch_array($db_query_file)){
				
				$namefile=$result_file["date_upload"]."/".$result_file["name"];
				$fileupload=$result_file["up1"];
				$userupload=$result_file["qid"];
				if($fileupload==2) {
					$upfile2=$namefile;
				} else { $upfile2 = ''; }
			}
			$sql_file="select * from sbk_tmp_upload where  qid='".$username2."' and up1=3 ";
			$db_query_file=mysql_db_query($dbname,$sql_file) or die(mysql_error()."Error select picture by command".$sql_file); 
//			$result_file = mysql_fetch_array($db_query_file);
			while($result_file=mysql_fetch_array($db_query_file)){
				
				$namefile=$result_file["date_upload"]."/".$result_file["name"];
				$fileupload=$result_file["up1"];
				$userupload=$result_file["qid"];
				if($fileupload==3) {
					$upfile3=$namefile;
				} else { $upfile3 = ''; }
			}
			$sql_file="select * from sbk_tmp_upload where  qid='".$username2."' and up1=4 ";
			$db_query_file=mysql_db_query($dbname,$sql_file) or die(mysql_error()."Error select picture by command".$sql_file); 
//			$result_file = mysql_fetch_array($db_query_file);
			while($result_file=mysql_fetch_array($db_query_file)){
				
				$namefile=$result_file["date_upload"]."/".$result_file["name"];
				$fileupload=$result_file["up1"];
				$userupload=$result_file["qid"];
				if($fileupload==4) {
					$upfile4=$namefile;
				} else { $upfile4 = ''; }
			}
			$sql_file="select * from sbk_tmp_upload where  qid='".$username2."' and up1=5 ";
			$db_query_file=mysql_db_query($dbname,$sql_file) or die(mysql_error()."Error select picture by command".$sql_file); 
//			$result_file = mysql_fetch_array($db_query_file);
			while($result_file=mysql_fetch_array($db_query_file)){
				
				$namefile=$result_file["date_upload"]."/".$result_file["name"];
				$fileupload=$result_file["up1"];
				$userupload=$result_file["qid"];
				if($fileupload==5) {
					$upfile5=$namefile;
				} else { $upfile5 = ''; }
			}

	/*			if($fileupload==2) {
					$upfile2=$namefile;
				} else { $upfile2 = ''; }
				
				if($fileupload==3) {
					$upfile3=$namefile;
				} else { $upfile3 = ''; }
				
				if($fileupload==4) {
					$upfile4=$namefile;
				}else { $upfile4 = ''; } 
				
				if($fileupload==5) {
					$upfile5=$namefile;
				}else { $upfile5 = ''; }
		*/		
				//	$upfile1="";
				//	$upfile2="";
				//	$upfile3="";
				//	$upfile4="";
				//	$upfile5="";
			
			

	$sql9="update sbk_book set file1='$upfile1', file2='$upfile2', file3='$upfile3', file4='$upfile4', file5='$upfile5' where id='$book_sended_id' ";
	$dbquery9=mysql_db_query($dbname, $sql9) or die(mysql_error()."Error  by command".$sql9); 


		$sql10="delete  from sbk_tmp_upload where qid='".$username2."' ";
		$dbquery10=mysql_db_query($dbname, $sql10);


	echo"<script language='javascript'>
	alert('บันทึกการส่งหนังสือราชการเรียบร้อยครับ');
	window.location='sendbook.php';
	</script>";
	
} else { 
	echo"<script language='javascript'>
	alert('กรุณาเลือกผู้รับหนังสือด้วยครับ');
	window.location='sendbook.php';
	</script>";	
	
	}

}
?>