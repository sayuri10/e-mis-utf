<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
			echo"<meta http-equiv='refresh' content='0;URL=../../index.php'>";
			exit(); 
} else {
		
		$admin_name=$_SESSION["admin_name"];
		$admin_id=$_SESSION["admin_id"];
	include '../../inc/connect_db.php';
	

?>
<?
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;
?>

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

$search_doc_date="";
$search_start_receive="";
$search_last_send="";

if($_POST["doc_date"]) {
	//แยกวันที่ 
	$arrdate= explode("-", $_POST["doc_date"] );
	$date_doc_day = $arrdate[0]; // tree
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // one
	$frm_doc_date=$date_doc_year."-".$date_doc_month."-".$date_doc_day;
	$search_doc_date=thai_date($frm_doc_date);
}
if($_POST["start_date_send"]) {
	//แยกวันที่ 
	$arrdate= explode("-", $_POST["start_date_send"] );
	$date_doc_day = $arrdate[0]; // tree
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // one
	$frm_start_send=$date_doc_year."-".$date_doc_month."-".$date_doc_day;
	$search_start_send="ตั้งแต่ ".thai_date($frm_start_send);
}
if($_POST["last_date_send"]) {
	//แยกวันที่ 
	$arrdate= explode("-", $_POST["last_date_send"] );
	$date_doc_day = $arrdate[0]; // tree
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // one
	$frm_last_send=$date_doc_year."-".$date_doc_month."-".$date_doc_day;
	$search_last_send="ถึง ".thai_date($frm_last_send);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<link href="../../mystyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #e5e5e5;
}
-->
</style></head>

<body >
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="../../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> ผลการค้นหาหนังสือราชการออก</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">

	<tr>
    <td align="center"><br><b>&nbsp;ผลการค้นหา :</b> <?=$_POST["doc_num"];?> <?=$search_doc_date?> <?=$_POST["doc_title"];?> 
	<?=$search_start_send;?> <?=$search_last_send;?> 
		</td>
  </tr>

  <tr>
    <td>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td><table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="40">ที่</td>
            <td width="25"><IMG SRC="../../images/priority/5.gif" BORDER="0"  width=17 height=12 alt="ความสำคัญ" ></td>
            <td width="125">เลขที่</td>
            <td width="90">ลงวันที่</td>
            <td width="270">เรื่อง</td>
            <td width="130">จาก</td>
            <td width="130">ถึง/รับ</td>
          </tr>
          </tr>
		  <?

	  	if($_POST["start_date_send"] and $_POST["last_date_send"]){

//แยกวันที่ ค้นหาวันที่เริ่มใน database
	$arrdate= explode("-", $_POST["start_date_send"] );
	$date_doc_day = $arrdate[0]; // one
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // tree
	$start=$date_doc_year."-".$date_doc_month."-".$date_doc_day;
	$start_date_doc=$start;

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$arrdate2= explode("-", $_POST["last_date_send"] );
	$date_doc_day2 = $arrdate2[0]; // one
	$date_doc_month2 = $arrdate2[1]; // two
	$date_doc_year2 = $arrdate2[2]-543; // tree
	$last=$date_doc_year2."-".$date_doc_month2."-".$date_doc_day2;
	$last_date_doc=$last;
	
	$search_send_date=" and (sbk_book.date_post  between '$start_date_doc' and '$last_date_doc') ";

	}else if($_POST["start_date_send"] and !$_POST["last_date_send"]){

//แยกวันที่ ค้นหาวันที่เริ่มใน database
	$arrdate= explode("-", $_POST["start_date_send"] );
	$date_doc_day = $arrdate[0]; // one
	$date_doc_month = $arrdate[1]; // two
	$date_doc_year = $arrdate[2]-543; // tree
	$start=$date_doc_year."-".$date_doc_month."-".$date_doc_day;
	$start_date_doc=$start;

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$last=$curYear."-".$curMonth."-".$curDay;
	$last_date_doc=$last;

	$search_send_date=" and (sbk_book.date_post  between '$start_date_doc' and '$last_date_doc') ";

	}else if(!$_POST["start_date_send"] and $_POST["last_date_send"]){

//แยกวันที่ ค้นหาวันที่เริ่มใน database
	$start=$search_no_start;
	$start_date_doc=$start;

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$arrdate2= explode("-", $_POST["last_date_send"] );
	$date_doc_day2 = $arrdate2[0]; // one
	$date_doc_month2 = $arrdate2[1]; // two
	$date_doc_year2 = $arrdate2[2]-543; // tree
	$last=$date_doc_year2."-".$date_doc_month2."-".$date_doc_day2;
	$last_date_doc=$last;
	
		$search_send_date=" and (sbk_book.date_post  between '$start_date_doc' and '$last_date_doc') ";

	}else{
	$start_date_doc='';
	$last_date_doc='';
	$search_send_date="";
	}
	//หาเลขที่หนังสือ
	if($_POST["doc_num"]){
	$search_doc_num=" and sbk_book.doc_num like '%".$_POST["doc_num"]."%' ";
	}else{
	$search_doc_num="";
	}
	//หาลงวันที่
	if($_POST["doc_date"]){

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$arrdate3= explode("-", $_POST["doc_date"] );
	$date_doc_day3 = $arrdate3[0]; // one
	$date_doc_month3 = $arrdate3[1]; // two
	$date_doc_year3 = $arrdate3[2]-543; // tree
	$doc_date=$date_doc_year3."-".$date_doc_month3."-".$date_doc_day3;

	$search_doc_date=" and sbk_book.date_doc like '%".$doc_date."%' ";
	}else{
	$search_doc_date="";
	}
	//หาชื่อหนังสือ
	if($_POST["doc_title"]){
	$search_doc_title=" and sbk_book.book_title like '%".$_POST["doc_title"]."%' ";
	}else{
	$search_doc_title="";
	}

		  		$sql="select * from sbk_book $sum_location_bookfrom  $search_doc_num $search_doc_date $search_doc_title $search_doc_num $search_send_date  order by id desc ";
			    $num=1;
			
				$dbquery2=mysql_db_query($dbname, $sql);
				$Num_Rows = mysql_num_rows($dbquery2);


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
					if($allsend_file1<>'')$count_file++;
					if($allsend_file2<>'')$count_file++;
					if($allsend_file3<>'')$count_file++;
					if($allsend_file4<>'')$count_file++;
					if($allsend_file5<>'')$count_file++;
					if($count_file <>0) {$count_file='<img src="../../images/file.gif"  width="16" height="16" align="absmiddle" >';}
						else {$count_file='-'; }

				
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

					//แสดงชื่อผู้ส่งหนังสือ
						$sql7="select name from sbk_organize where id=$allsend_book_from ";
						$db_query7=mysql_db_query($dbname,$sql7);
					while($result7 = mysql_fetch_array($db_query7))
					{
							$name_sender="".$result7[0]."";								
					}

						//นับจำนวนโรงเรียนที่ส่ง หากส่งโรงเดียวให้แสดงชื่อ
						$sql5="select count(id) from sbk_sendbook where bookID=$allsend_id ";
						$db_query5=mysql_db_query($dbname,$sql5);
					while($result5 = mysql_fetch_array($db_query5))
					{
							$count_tosend=$result5[0]."";		
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
			


			}
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
							$status_receive=" ".$num_receive."";
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
						}else{
							$status_book="$count_tosend";
							$status_edit="<a href='cancel_book.php?cancel_book_id=$allsend_id' class='textnormal'>ยกเลิก </a>";
						}
					//แสดงผล
					echo"<tr class='text' bgcolor='$bg'>
						<td align='center'>$num</td>
						<td align='center'><IMG SRC=\"../../images/priority/$imgShowPiority\" BORDER=\"0\"  width=14 height=11 alt=\"$priority_name\" ></td>
						<td >$allsend_doc_num</td>
						<td align='center'>$thai_date_doc</td>
						<td ><a href=\"../../book_detail.php?book_detail_id=$allsend_id \" class=\"textnormal\" target=\"_blank\" >&nbsp;$allsend_book_title</a></td>
						<td align='center'>$name_sender</td>
						<td align='center'>$count_tosend/$status_receive </td>
					</tr>";
				$num++;

				}
		  ?>
        </table></td>
      </tr>
<!-- //แทรกหน้า  -->
<tr><td>
				<div align="center"><br> 
	  <span class="text">ค้นพบหนังสือราชการออก
      <?= $Num_Rows;?>  รายการ 
	  </div>
</td>
</tr>



    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
<? mysql_close(); 
}
  ?>