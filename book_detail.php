<?
	include'inc/connect_db.php';

$book_detail_id=$_GET["book_detail_id"];
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


	if($book_detail_id){


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายละเอียดหนังสือราชการ</title>
<link href="mystyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-top: 10px;
}
-->
</style></head>

<body>
		  <?
		  		$sql="select * from sbk_book where id=$book_detail_id  ";
				$dbquery=mysql_db_query($dbname, $sql);
				while($result=mysql_fetch_array($dbquery))
				{
					$detailbook_id=$result[id];
					$detailbook_priority=$result[priority];
					$detailbook_doc_num=$result[doc_num];
					$detailbook_book_title=$result[book_title];
					$detailbook_date_doc=$result[date_doc];
					$detailbook_book_from=$result[book_from];
					$detailbook_from_type=$result[from_type];
					$detailbook_to_type=$result[to_type];
					$detailbook_detail=$result[detail];
					$detailbook_date_post=$result[date_post];
					$detailbook_send_num=$result[send_num];
					$detailbook_respond=$result[respond];
					$detailbook_file1=$result[file1];
					$detailbook_file2=$result[file2];
					$detailbook_file3=$result[file3];
					$detailbook_file4=$result[file4];
					$detailbook_file5=$result[file5];
					$detailbook_status=$result[status];
					$detailbook_year=$result[year];
					
				

				
						//แปลงวันที่
						$thai_date_post=thai_date($detailbook_date_post);
						$thai_date_doc=thai_date($detailbook_date_doc);

						//แสดงชื่อผู้ส่ง
						$sql3="select * from sbk_organize where id=$detailbook_book_from ";
						$db_query3=mysql_db_query($dbname,$sql3);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$sender_name=$result3[name];		
					}
						//แสดงชื่อความสำคัญ
						$imgShowPiority=(trim($detailbook_priority)=="")? "1.gif":$detailbook_priority.".gif";

						$sql4="select * from sbk_priority where id=$detailbook_priority ";
						$db_query4=mysql_db_query($dbname,$sql4);
					while($result4 = mysql_fetch_array($db_query4))
					{
							$priority_name=$result4["name_priority"];		
					}
						

						//นับจำนวนโรงเรียนที่ส่ง หากส่งโรงเดียวให้แสดงชื่อ
						$sql5="select count(id) from sbk_sendbook where bookID=$detailbook_id ";
						$db_query5=mysql_db_query($dbname,$sql5);
					while($result5 = mysql_fetch_array($db_query5))
					{
							$count_tosend=$result5[0]." โรง";		
					}
							if($count_tosend==1) {
						$sql6="select book_to from sbk_sendbook where bookID=$detailbook_id ";
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
						$sql9="select count(id) from sbk_sendbook where receive<>0 and bookID=$detailbook_id ";
						$db_query9=mysql_db_query($dbname,$sql9);
					while($result9 = mysql_fetch_array($db_query9))
					{
							$num_receive=$result9[0];								
					}
					if($num_receive==0) {
						$status_receive=" - ";
						}else{
							$status_receive=$num_receive." โรง";
						}

					

					//สลับสีตามความสำคัญ
					if($detailbook_priority == 1) { //ส่วนของการ สลับสี 
					$bg = "#DFE6F1";
					} else if($detailbook_priority == 2) {
					$bg = "#ffaaaa";
					}else if($detailbook_priority == 3) {
					$bg = "#ffaaaa";
					} else if($detailbook_priority == 4) {
					$bg = "#f48600";
					}else if($detailbook_priority == 5) {
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
					if($detailbook_status==0) {
						$status_book="ยกเลิก";
						$status_edit=" -  ";
						$bg = "#808080";
						$status_receive="ยกเลิก";
						}else{
							$status_book="$count_tosend";
							$status_edit="<a href='cancel_book.php?cancel_book_id=$detailbook_id' class='textnormal'>ยกเลิก </a>";
						}
				}

	?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="images/application_add.gif" width="16" height="16" align="absmiddle" /> รายละเอียดหนังสือราชการ</td>
  </tr>
</table>

<table width="95%" border="0" align="center" cellpadding="3" cellspacing="5" class="borderall_green">
  
  <tr>
    <td width="14%" class="blue_bg_color"><div align="right"><strong>วันที่ส่ง : </strong></div></td>
    <td width="86%" class="yellow_bg_color">
	<? echo $thai_date_post; ?>
	</td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>ลำดับหนังสือ : </strong></div></td>
    <td class="yellow_bg_color">
	<? echo $detailbook_send_num." / ".$detailbook_year; ?>
	  </td>
  </tr>
<tr>
    <td class="blue_bg_color"><div align="right"><strong>ความสำคัญ : </strong></div></td>
    <td class="yellow_bg_color"><b>
	<? echo $priority_name; ?>
	  </b></td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>เลขที่หนังสือ : </strong></div></td>
    <td class="yellow_bg_color">
	<? echo $detailbook_doc_num; ?>
	  </td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>ลงวันที่ : </strong></div></td>
    <td class="yellow_bg_color">
	<? echo $thai_date_doc; ?>
	  </td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>เรื่อง : </strong></div></td>
    <td class="yellow_bg_color">
	<? echo $detailbook_book_title; ?>
	  </td>
  </tr>
    <tr>
    <td class="blue_bg_color" valign="top"><div align="right"><strong>ถึง : </strong></div></td>
    <td class="yellow_bg_color">
	<? 
	  					$sql_to="select * from sbk_sendbook where bookID=$book_detail_id ";
						$db_query_to=mysql_db_query($dbname,$sql_to);
					while($result_to = mysql_fetch_array($db_query_to))
					{
							$to_id=$result_to[book_to];								
							$to_received=$result_to[receive];	
							$to_rec=$result_to[date_receive];
						$sql_org_to="select name from sbk_organize where id=$to_id ";
						$db_query_org_to=mysql_db_query($dbname,$sql_org_to);
					while($result_org_to = mysql_fetch_array($db_query_org_to))
					{
							$name_tosend=$result_org_to[0];								
					}
					
					if($to_received==0){
					  echo $name_tosend." , <br/>"; 
					}else
					//echo "<font color=\"#FF6600\" >".$name_tosend."[".$to_rec."]</font> , <br/>"; 
					echo "<font color=\"#339966\" >".$name_tosend."[".$to_rec."]</font> , <br/>"; 
					}

  
  
  ?>
	</td>
  </tr>

  <tr>
    <td class="blue_bg_color" valign="top"><div align="right" ><strong>รายละเอียด : </strong></div></td>
    <td class="yellow_bg_color">
	<textarea name="detail" cols="80" rows="5" id="detail" readonly><? echo "$detailbook_detail";?></textarea> 
       </td>
  </tr>

  <? if (substr($detailbook_file1,-3)=="pdf") {?>
  <tr>
    <td class="blue_bg_color"  valign="top"><div align="right"><strong>ตัวอย่างเอกสาร : <br />แสดงหน้าแรก<br/>จากเอกสารทั้งหมด</strong></div></td>
    <td class="yellow_bg_color"><iframe src="read.php?book_detail_id=<? echo $book_detail_id; ?>" width="850" height="1000" frameborder="1"></iframe></td>
  </tr>
  <? } ?>
  
  
  <tr>
    <td class="blue_bg_color"  valign="top"><div align="right"><strong>ไฟล์แนบ : </strong></div></td>
    <td class="yellow_bg_color">


<? 

					$count_file=0;
					if($detailbook_file1<>''){
						$count_file++;
					echo "<b><font color=\"red\">[<a href=\"$folder_downloadfile/$detailbook_file1\" target=\"_blank\">ไฟล์แนบที่ $count_file</a>] </font></b><br><br>";	
					}
					if($detailbook_file2<>''){
						$count_file++;
					echo "<b><font color=\"red\">[<a href=\"$folder_downloadfile/$detailbook_file2\" target=\"_blank\">ไฟล์แนบที่ $count_file</a>] </font></b><br><br>";	
					}
					if($detailbook_file3<>''){
						$count_file++;
					echo "<b><font color=\"red\">[<a href=\"$folder_downloadfile/$detailbook_file3\" target=\"_blank\">ไฟล์แนบที่ $count_file</a>] </font></b><br><br>";	
					}
					if($detailbook_file4<>''){
						$count_file++;
					echo "<b><font color=\"red\">[<a href=\"$folder_downloadfile/$detailbook_file4\" target=\"_blank\">ไฟล์แนบที่ $count_file</a>] </font></b><br><br>";	
					}
					if($detailbook_file5<>''){
						$count_file++;
					echo "<b><font color=\"red\">[<a href=\"$folder_downloadfile/$detailbook_file5\" target=\"_blank\">ไฟล์แนบที่ $count_file</a>] </font></b><br><br>";	
					}
					if($count_file <>0) {
						$download_num=$count_file;
		//				$count_file='<img src="images/file.gif"  width="16" height="16" align="absmiddle" >';
						}
						else {
							echo "<font color=\"red\"><b> ไม่มีไฟล์แนบ </b></font><br>"; 
						}

  
  ?>
	  </td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong> ผู้ส่งหนังสือ : </strong></div></td>
    <td class="yellow_bg_color"> <font color="#336666">
	<b> 
	<? echo $sender_name; ?>
	</b></font></td>
  </tr>
  <tr>
    <td class="blue_bg_color">&nbsp;</td>
    <td class="yellow_bg_color"></td>
  </tr>
</table>


<p align="center">
  <input type="submit" name="Submit" value="ปิดหน้าต่าง" onclick="window.close();" />
</p>


</body>
</html>
<?
}else {
echo "ไม่พบหน้าที่ต้องการครับ";
}