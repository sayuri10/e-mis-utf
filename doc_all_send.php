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
<link href="mystyle.css" rel="stylesheet" type="text/css" />
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
    <td class="title_bg_text_no_center_blue"><img src="images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> หนังสือราชการออกทั้งหมด</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td>
        <table bgcolor="#FFFFFF"><tr><td><a href="doc_search_send.php"> - ค้นหา - </a></td></tr></table>
        <br />
        <table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="60">เลขออก</td>
            <td width="82">วันที่ส่ง</td>
            <td width="25"><IMG SRC="images/priority/5.gif" BORDER="0"  width=17 height=12 alt="ความสำคัญ" ></td>
            <td width="125">เลขที่</td>
            <td width="250">เรื่อง</td>
            <td width="100">ถึง | รับ</td>
            <td width="70">ดำเนินการ</td>
          </tr>
		  <?
		  		$sql="select * from sbk_book where book_from=$userorganize_id order by send_num desc ";
							
		  		$Per_Page =$Per_Pages;
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
				$dbquery2=mysql_db_query($dbname, $sql);
				
				$Page_start = ($Per_Page*$Page)-$Per_Page;
				$Num_Rows = mysql_num_rows($dbquery2);
		//		$num=$Num_Rows;
				if($Num_Rows<=$Per_Page)
				$Num_Pages =1;
				else if(($Num_Rows % $Per_Page)==0)
				$Num_Pages =($Num_Rows/$Per_Page) ;
				else 
				$Num_Pages =($Num_Rows/$Per_Page) +1;
				
				$Num_Pages = (int)$Num_Pages;
				
				if(($Page>$Num_Pages) || ($Page<0))
				print "<center><b>จำนวน $Page มากกว่า $Num_Pages ยังไม่มีข้อความ<b></center>";
				$sql .= "LIMIT $Page_start , $Per_Page";

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
					if($count_file <>0) {$count_file='<img src="images/file.gif"  width="16" height="16" align="absmiddle" >';}
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
						}else{
							$status_book="$count_tosend";
							$status_edit="<a href='cancel_book.php?cancel_book_id=$allsend_id' class='textnormal'>ยกเลิก </a>";
						}
					//แสดงผล
					echo"<tr class='text' bgcolor='$bg'>
						<td align='center'>$allsend_send_num/$allsend_year</td>
						<td align='center'>$thai_date_post</td>
						<td align='center'><IMG SRC=\"images/priority/$imgShowPiority\" BORDER=\"0\"  width=14 height=11 alt=\"$priority_name\" ></td>
						<td >&nbsp;$allsend_doc_num</td>
						<td ><a href=\"book_detail.php?book_detail_id=$allsend_id\" class=\"textnormal\" target=\"_blank\" >&nbsp;$allsend_book_title</a></td>
						<td align='center'>$status_book | $status_receive</td>
						<td align='center'>$status_edit</td>
					</tr>";
				$num++;

				}
		  ?>
        </table></td>
      </tr>
<!-- //แทรกหน้า  -->
<tr><td>
				<div align="center"><br> 
	  <span class="text">มีรายการหนังสือราชการออกทั้งหมด
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