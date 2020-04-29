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
	
?>
<?
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;

	if($_GET["start_date"] and $_GET["last_date"]){
		//แยกวันที่ ค้นหาวันที่เริ่มใน database
	$arrdate= explode("-", $_GET["start_date"] );
	$date_doc_day = $arrdate[0]; // one
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // tree
	$start=$date_doc_year."-".$date_doc_month."-".$date_doc_day;

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$arrdate2= explode("-", $_GET["last_date"] );
	$date_doc_day2 = $arrdate2[0]; // one
	$date_doc_month2 = $arrdate2[1]; // two
	$date_doc_year2 = $arrdate2[2]-543; // tree
	$last=$date_doc_year2."-".$date_doc_month2."-".$date_doc_day2;

		$start_date=$_GET["start_date"] ;
		$last_date=$_GET["last_date"] ;

//แยกวันที่ ค้นหาวันที่เริ่มใน database
	$start_date_doc=$start;

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$last_date_doc=$last;
	}
?>
<link href="mystyle.css" rel="stylesheet"  />
<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #e5e5e5;
}
-->
</style>

<?php
//แปลงวันที่ไทย
function thai_date($strDate)	{
		$strYear = date("y",strtotime($strDate))+43;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

$start2=thai_date($start);
$last2=thai_date($last);
					$sql11="select name from sbk_organize where id=$userorganize_id ";
						$db_query11=mysql_db_query($dbname,$sql11);
					while($result11 = mysql_fetch_array($db_query11))
					{
							$name_tosend="".$result11[0]."";								
					}
#header('Content-type: application/csv');
#header("Content-Disposition: attachment; filename=report-$name_tosend-$start2 ถึง $last2.csv"); 
echo "<div align='right'><img src='images/print.gif' width=18 height=18 > <input type=\"button\" value=\"- = พิมพ์รายงานหนังสือออก = -\" onClick=window.print()>";  
echo "&nbsp; &nbsp; &nbsp; </div>";
echo "<div align='center'><b>รายงานหนังสือราชการออกของ  $name_tosend   <br>";  
echo "ระหว่างวันที่  $start2  ถึงวันที่  $last2  </b></div>"; 
//$id=1;
/*
$date=$result[date];
$number2=$result[number2];
$date2=$result[date2];
$fr=$result[fr];
$subject=$result[subject];
*/
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td><table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="on_report1" align="center"><b>
            <td align='center' width="20">ที่</td>
            <td align='center' width="60">เลขออก</td>
            <td align='center' width="82">วันที่ส่ง</td>
            <td align='center' width="70">ความสำคัญ</td>
            <td align='center' width="130">หนังสือเลขที่</td>
            <td align='center' width="82">ลงวันที่</td>
 <!--           <td align='center' width="40">ไฟล์แนบ</td>  -->
            <td align='center' width="290">เรื่อง</td>
            <td align='center' width="120">ถึงหน่วยงาน</td>
            <td align='center' width="60">หมายเหตุ</td></b>
          </tr>




<?
    
	$num=1;
			  // ตรงนี้คือ sql statement ในการดึงข้อมูลมาจากฐานข้อมูล 
		  		$sql="select * from sbk_book where book_from=$userorganize_id and (date_post  between '$start_date_doc' and '$last_date_doc') order by send_num  ";
				$dbquery=mysql_db_query($dbname, $sql);
				while($result=mysql_fetch_array($dbquery))
				{
					$allsend_id=$result[id];
					$allsend_priority=$result[priority];
					$allsend_doc_num=$result[doc_num];
					$allsend_book_title=$result[book_title];
					$allsend_date_doc=$result[date_doc];
					$allsend_book_from=$result[book_from];
					$allsend_from_type=$result[from_type];
					$allsend_to_type=$result[to_type];
					$allsend_detail=$result[detail];
					$allsend_date_post=$result[date_post];
					$allsend_year=$result[year];
					$allsend_send_num=$result[send_num];
					$allsend_respond=$result[respond];
					$allsend_file1=$result[file1];
					$allsend_file2=$result[file2];
					$allsend_file3=$result[file3];
					$allsend_file4=$result[file4];
					$allsend_file5=$result[file5];
					$allsend_status=$result[status];
				

					//แสดงรายละเอียดหนังสือ
					$book_detail_id=$allsend_id;

					$count_file=0;
					$count_file2=0;

					if($allsend_file1<>'')$count_file++;
					if($allsend_file2<>'')$count_file++;
					if($allsend_file3<>'')$count_file++;
					if($allsend_file4<>'')$count_file++;
					if($allsend_file5<>'')$count_file++;
					if($count_file <>0) {$count_file2=$count_file; $count_file='<img src="images/file.gif"  width="16" height="16" align="absmiddle" >'; }
						else {$count_file='-'; $count_file2='-'; }
						//แปลงวันที่
						$thai_date_post=thai_date($allsend_date_post);
						$thai_date_doc=thai_date($allsend_date_doc);
						//แสดงกลุ่ม
						$sql3="select * from sbk_group where id=$allsend_book_from ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
					//		$group_typeid=$result3["typeID"];
							$group_name=$result3["name"];		
					}
						//แสดงชื่อความสำคัญ
						$imgShowPiority=(trim($allsend_priority)=="")? "1.gif":$allsend_priority.".gif";

						$sql4="select * from sbk_priority where id=$allsend_priority ";
						$db_query4=mysql_db_query($dbname,$sql4);
					while($result4 = mysql_fetch_array($db_query4))
					{
							$priority_name=$result4["name_priority"];		
					}
/*
						//นับจำนวนโรงเรียนที่ส่ง หากส่งโรงเดียวให้แสดงชื่อ
						$name_alltosend='';
							
						$sql6="select book_to from sbk_sendbook where bookID=$allsend_id ";
						$db_query6=mysql_db_query($dbname,$sql6);
					while($result6 = mysql_fetch_array($db_query6))
					{
						$to_id=$result6["book_to"];
						$sql7="select name from sbk_organize where id=$to_id ";
						$db_query7=mysql_db_query($dbname,$sql7);
					while($result7 = mysql_fetch_array($db_query7))
						{
							$named_tosend="".$result7[0]."";								
							$name_alltosend=$name_alltosend." - ".$named_tosend;

						}
					}
*/
					//นับจำนวนโรงเรียนที่ส่ง หากส่งโรงเดียวให้แสดงชื่อ
						$sql5="select count(id) from sbk_sendbook where bookID=$allsend_id ";
						$db_query5=mysql_db_query($dbname,$sql5);
					while($result5 = mysql_fetch_array($db_query5))
					{
							$count_tosend=$result5[0]." แห่ง";		
					}
							if($count_tosend==1) {
						$sql6="select book_to from sbk_sendbook where bookID=$allsend_id ";
						$db_query6=mysql_db_query($dbname,$sql6);
					while($result6 = mysql_fetch_array($db_query6))
					{
							$to_id=$result6[0];								
					}
						$sql7="select name from sbk_organize where id=$to_id ";
						$db_query7=mysql_db_query($dbname,$sql7);
					while($result7 = mysql_fetch_array($db_query7))
					{
							$count_tosend="".$result7[0]."";								
					}
				}   //if($count_tosend)

							
							
				
							
					//นับจำนวนผู้ลงทะเบียนรับแล้ว
						$sql9="select count(id) from sbk_sendbook where receive<>0 and bookID=$allsend_id ";
						$db_query9=mysql_db_query($dbname,$sql9);
					while($result9 = mysql_fetch_array($db_query9))
					{
							$num_receive=$result9[0];								
					}
					if($num_receive==0) {
						$status_receive=" - ";
						}else{
							$status_receive=$num_receive." แห่ง";
						}
					//สลับสีตามความสำคัญ
					if($allsend_priority == 1) { //ส่วนของการ สลับสี 
					$bg = "#DFE6F1";
					} else if($allsend_priority == 2) {
					$bg = "#ffaaaa";
					}else if($allsend_priority == 3) {
					$bg = "#ffaaaa";
					} else if($allsend_priority == 4) {
					$bg = "#f48600";
					}else if($allsend_priority == 5) {
					$bg = "#F8F7DE";
					}else {
					$bg = "#DFE6F1";
					}
				//	if($bg == "#DFE6F1") { //ส่วนของการ สลับสี 
				//	$bg = "#F8F7DE";
				//	} else {
				//	$bg = "#DFE6F1";
				//	}
					//กรณีหนังสือมีการยกเลิก
					if($allsend_status==0) {
						$status_book="ยกเลิก";
						$status_edit=" -  ";
						$bg = "#808080";
						$status_receive="ยกเลิก";
						$show_status="ยกเลิก";
						}else{
							$status_book="$count_tosend";
							$status_edit="<a href='cancel_book.php?cancel_book_id=$allsend_id' class='textnormal'>ยกเลิก </a>";
						$show_status="&nbsp;";
						}
					//แสดงผล
		//			echo"$num,$allsend_send_num/$allsend_year,$thai_date_post,$priority_name,$allsend_doc_num,$thai_date_doc,$count_file2,$allsend_book_title,$name_alltosend,$status_receive,\n";
				
	/*			echo"<tr >
						<td align='center'>$num</td>
						<td align='center'>$allsend_send_num/$allsend_year</td>
						<td align='center'>$thai_date_post</td>
						<td align='center'>$priority_name</td>
						<td >$allsend_doc_num</td>
						<td align='center'>$thai_date_doc</td>
						<td align='center'>$count_file2</td>
						<td >&nbsp;$allsend_book_title</td>
						<td >$name_alltosend</td>
						<td align='center'>$show_status </td>
					</tr>";

					*/
				echo"<tr >
						<td align='center'>$num</td>
						<td align='center'>$allsend_send_num/$allsend_year</td>
						<td align='center'>$thai_date_post</td>
						<td align='center'>$priority_name</td>
						<td >$allsend_doc_num</td>
						<td align='center'>$thai_date_doc</td>
						<td >&nbsp;$allsend_book_title</td>
						<td align='center'>$count_tosend</td>
						<td align='center'>$show_status </td>
					</tr>";

				
				
				
				
				
				$num++;
			

			}  //ออก if get วันที่

	?>

	<? 
	mysql_close(); 
	}
	?>