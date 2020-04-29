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
    <td class="title_bg_text_no_center_blue"><img src="../../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> หนังสือราชการเข้า <?=$show_top_saraban;?> รายการล่าสุด</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td><table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="40">ที่</td>
            <td width="90">วันที่ส่ง</td>
            <td width="25"><IMG SRC="../../images/priority/5.gif" BORDER="0"  width=17 height=12 alt="ความสำคัญ" ></td>
            <td width="125">เลขที่</td>
            <td width="270">เรื่อง</td>
            <td width="130">จาก</td>
            <td width="130">ถึง/รับ</td>
          </tr>
		  <?	
//location  //typeID
		
						//เช็คหนังสือเข้าทั้งหมด
		//		$sql2="select * from sbk_sendbook $sum_location_bookto  order by bookID desc";
		  		$sql2="select * from sbk_book $sum_location_bookto Order by id desc  ";
		//แบ่งหน้า			
		  		$Per_Page =$show_top_saraban;
				if(!$_GET["Page"]){
	 		    $Page=1;
				$num=1;
				}else{
					$Page=$_GET["Page"];
					$num=($Per_Page*($Page-1))+1;
				}
				$Prev_Page = $Page-1;
				$Next_Page = $Page+1;
				//echo $sql;
				$dbquery3=mysql_db_query($dbname, $sql2);
				
				$Page_start = ($Per_Page*$Page)-$Per_Page;
				$Num_Rows = mysql_num_rows($dbquery3);

				if($Num_Rows<=$Per_Page)
				$Num_Pages =1;
				else if(($Num_Rows % $Per_Page)==0)
				$Num_Pages =($Num_Rows/$Per_Page) ;
				else 
				$Num_Pages =($Num_Rows/$Per_Page) +1;
				
				$Num_Pages = (int)$Num_Pages;
				
				if(($Page>$Num_Pages) || ($Page<0))
				print "<center><b>จำนวน $Page มากกว่า $Num_Pages ยังไม่มีข้อความ<b></center>";
				$sql2 .= " LIMIT $Page_start , $Per_Page";
				
				
		//		if(!$_GET["Page"]){
		//		$num=$Num_Rows;
		//		}else{
		//			$num=$Num_Rows-($Per_Page*($Page-1));
		//		}
				
			//	$sql="select * from sbk_book Order by id desc  LIMIT 0 , $Page_index ";

				$dbquery=mysql_db_query($dbname, $sql2);
				
				while($result=mysql_fetch_array($dbquery))
				{
					$all_id=$result[id];
					$all_priority=$result[priority];
					$all_doc_num=$result[doc_num];
					$all_book_title=$result[book_title];
					$all_date_doc=$result[date_doc];
					$all_book_from=$result[book_from];
					$all_from_type=$result[from_type];
					$all_to_type=$result[to_type];
					$all_detail=$result[detail];
					$all_date_post=$result[date_post];
					$all_send_num=$result[send_num];
					$all_respond=$result[respond];
					$all_file1=$result[file1];
					$all_file2=$result[file2];
					$all_file3=$result[file3];
					$all_file4=$result[file4];
					$all_file5=$result[file5];
					$all_status=$result[status];
					$all_year=$result[year];
				
					//แสดงรายละเอียดหนังสือ
					$book_detail_id=$all_id;

					$count_file=0;
					if($all_file1<>'')$count_file++;
					if($all_file2<>'')$count_file++;
					if($all_file3<>'')$count_file++;
					if($all_file4<>'')$count_file++;
					if($all_file5<>'')$count_file++;
					if($count_file <>0) {$count_file='<img src="../../images/file.gif"  width="16" height="16" align="absmiddle" >';}
						else {$count_file='-'; }

				
						//แปลงวันที่
						$thai_date_post=thai_date($all_date_post);
						$thai_date_doc=thai_date($all_date_doc);

						//แสดงกลุ่ม
						$sql3="select * from sbk_group where id=$all_book_from ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
					//		$group_typeid=$result3["typeID"];
							$group_name=$result3["name"];		
					}
						//แสดงชื่อความสำคัญ
						$imgShowPiority=(trim($all_priority)=="")? "1.gif":$all_priority.".gif";

						$sql4="select * from sbk_priority where id=$all_priority ";
						$db_query4=mysql_db_query($dbname,$sql4);
					while($result4 = mysql_fetch_array($db_query4))
					{
							$priority_name=$result4["name_priority"];		
					}
						

						//นับจำนวนโรงเรียนที่ส่ง หากส่งโรงเดียวให้แสดงชื่อ
						$sql5="select count(id) from sbk_sendbook where bookID=$all_id ";
						$db_query5=mysql_db_query($dbname,$sql5);
					while($result5 = mysql_fetch_array($db_query5))
					{
							$count_tosend=$result5[0]." ";		
					}
							if($count_tosend==1) {
						$sql6="select book_to from sbk_sendbook where bookID=$all_id ";
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
						$sql9="select count(id) from sbk_sendbook where receive<>0 and bookID=$all_id ";
						$db_query9=mysql_db_query($dbname,$sql9);
					while($result9 = mysql_fetch_array($db_query9))
					{
							$num_receive=$result9[0];								
					}
					if($num_receive==0) {
						$status_receive=" - ";
						}else{
							$status_receive=" ".$num_receive." ";
						}

					//หาชื่อผู้ส่ง
						$sql78="select name from sbk_organize where id=$all_book_from ";
						$db_query78=mysql_db_query($dbname,$sql78);
					while($result78 = mysql_fetch_array($db_query78))
					{
							$name_book_from="".$result78[0]."";								
					}
		

					//สลับสีตามความสำคัญ
					if($all_priority == 1) { //ส่วนของการ สลับสี 
					$bg = "#DFE6F1";
					} else if($all_priority == 2) {
					$bg = "#ffaaaa";
					}else if($all_priority == 3) {
					$bg = "#ffaaaa";
					} else if($all_priority == 4) {
					$bg = "#f48600";
					}else if($all_priority == 5) {
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
					if($all_status==0) {
						$status_book="ยกเลิก";
						$status_edit=" -  ";
						$bg = "#808080";
						$status_receive="ยกเลิก";
						}else{
							$status_book="$count_tosend";
							$status_edit="<a href='../../cancel_book.php?cancel_book_id=$allsend_id' class='textnormal'>ยกเลิก </a>";
						}
			
					

					//แสดงผล
					echo"<tr class='text' bgcolor='$bg'>
						<td align='center'>$num</td>
						<td align='center'>$thai_date_post</td>
						<td align='center'><IMG SRC=\"../../images/priority/$imgShowPiority\" BORDER=\"0\"  width=14 height=11 alt=\"$priority_name\" ></td>
						<td >$all_doc_num</td>
						<td ><a href=\"../../book_detail.php?book_detail_id=$all_id \" class=\"textnormal\" target=\"_blank\" >&nbsp;$all_book_title</a></td>
						<td align='center'>$name_book_from</td>
						<td align='center'>$count_tosend/$status_receive </td>
					</tr>";
			$num++;	
				}
		//		echo $sql2."-----".$sql."------".$sql4."------".$allreceive_priority;


		  ?>
        </table></td>
      </tr>

<!-- //แทรกหน้า  -->
<tr><td>
				<div align="center"><br> <? echo $sum_location; ?>
	  <span class="text">มีรายการหนังสือราชการรับจากโรงเรียนทั้งหมด
      <?= $Num_Rows;?>  รายการ แบ่ง <b> 
<?=$Num_Pages;?>
</b> หน้า : 
<? /* สร้างปุ่มย้อนกลับ */
if($Prev_Page) 
echo " <a href='$PHP_SELF?Page=$Prev_Page' class='text'><< ย้อนกลับ </a>";
for($i=1; $i<$Num_Pages; $i++){
if($i != $Page)
echo "[<a href='$PHP_SELF?Page=$i'  class='text'>$i</a>]";
else 
echo "<b> $i </b>";
}
/*สร้างปุ่มเดินหน้า */
if($Page!=$Num_Pages)
echo "<a href ='$PHP_SELF?Page=$Next_Page'  class='text'> หน้าถัดไป>> </a>";

?></div>
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