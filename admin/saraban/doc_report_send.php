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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>

	<!-- ปฏิทินภาษาไทย Datepicker  -->
		<link type="text/css" href="../../DatePicker/css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../../uploadify/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="../../DatePicker/js/jquery-ui-1.8.1.offset.datepicker.min.js"></script>
		<style type="text/css">
			/*demo page css*/
			body{ font: 80% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>	

<!---  เสร็จวันที่ -->



<link href="../../mystyle.css" rel="stylesheet"  />
<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #e5e5e5;
}
-->
</style>

</head>

<body >

		<script type="text/javascript">
		var todaydate='<?=$showtodaydate?>';
			$(function(){
				// Datepicker
			  $("#datepicker-th").datepicker({ dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
		</script>
		<script type="text/javascript">
		var todaydate2='<?=$showtodaydate?>';
			$(function(){
				// Datepicker
			  $("#datepicker-th2").datepicker({ dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate2,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-th-22").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd-mm-yy', yearOffset: 543, defaultDate: todaydate,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-en2").datepicker({ dateFormat: 'dd/mm/yy'});
			  $("#inline2").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
		</script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="../../images/application_add.gif" alt="title" width="16" height="16" align="absmiddle" /> รายงานหนังสือราชการออกทั้งหมด</td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="borderall_green">
  	<tr>
    <td align="center"><b>&nbsp;เลือกวันที่เริ่มต้น และวันที่สุดท้าย ที่ต้องการออกรายงาน</b></td>
  </tr>
    <tr>
    <form action="doc_report_send.php?start_date=<?=$start_date;?>&last_date=<?=$last_date;?>" name="form1" method="get">
	<td align="center">&nbsp; ตั้งแต่วันที่ <input name="start_date" type="text" id="datepicker-th" size="20"
	<?// if($_GET["start_date"]){ echo "value=\"".$_GET["start_date"]."\""; }
	?>
	/>  &nbsp; &nbsp; ถึงวันที่ <input name="last_date" type="text" id="datepicker-th2" size="20" 
	<? //if($_GET["last_date"]){ echo "value=\"".$_GET["last_date"]."\""; }
	?>
	/>
	  &nbsp; &nbsp; <input type="button" name="Button" value="แสดงรายงาน" onclick="chkform();"/></td>
  </form>
  </tr>
  <?	

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
	?>
  	<tr>
    <td align="center"><br><b>&nbsp;ผลการค้นหา :</b> ระหว่างวันที่ <b><?=thai_date($start);?></b> ถึงวันที่ <b><?=thai_date($last);?></b></td>
  </tr>
	<?
	}
	?>
<tr>
    <td>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td><table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="40">ที่</td>
            <td width="85">วันที่ส่ง</td>
            <td width="25"><IMG SRC="../../images/priority/5.gif" BORDER="0"  width=17 height=12 alt="ความสำคัญ" ></td>
            <td width="125">เลขที่</td>
            <td width="85">ลงวันที่</td>
            <td width="240">เรื่อง</td>
            <td width="110">จาก</td>
            <td width="110">ถึง/รับ</td>
          </tr>
		  <?
			if($_GET["start_date"] and $_GET["last_date"]){

//แยกวันที่ ค้นหาวันที่เริ่มใน database
	$start_date_doc=$start;

//แยกวันที่ ค้นหาวันที่สุดท้ายใน database
	$last_date_doc=$last;

		  		$sql="select * from sbk_book $sum_location_bookfrom and (date_post  between '$start_date_doc' and '$last_date_doc')  Order by id  ";
							
		  		$Per_Page =$Page_report;
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

		//		if(!$_GET["Page"]){
		//		$num=$Num_Rows;
		//		}else{
		//			$num=$Num_Rows-($Per_Page*($Page-1));
		//		}


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
							$status_receive=" ".$num_receive."";
						}


					//หาชื่อผู้ส่ง
						$sql78="select name from sbk_organize where id=$allsend_book_from ";
						$db_query78=mysql_db_query($dbname,$sql78);
					while($result78 = mysql_fetch_array($db_query78))
					{
							$name_book_from="".$result78[0]."";								
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
						<td align='center'>$thai_date_post</td>
						<td align='center'><IMG SRC=\"../../images/priority/$imgShowPiority\" BORDER=\"0\"  width=14 height=11 alt=\"$priority_name\" ></td>
						<td >$allsend_doc_num</td>
						<td align='center'>$thai_date_doc</td>
						<td ><a href=\"../../book_detail.php?book_detail_id=$allsend_id \" class=\"textnormal\" target=\"_blank\" >&nbsp;$allsend_book_title</a></td>
						<td align='center'>$name_book_from</td>
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
	  <span class="text">มีรายการหนังสือราชการออกทั้งหมด
      <?= $Num_Rows;?>  รายการ แบ่ง <b> 
<?=$Num_Pages;?>
</b> หน้า : 
<? /* สร้างปุ่มย้อนกลับ */
if($Prev_Page) 
echo " <a href='$PHP_SELF?start_date=$start_date&last_date=$last_date&Page=$Prev_Page' class='text'><< ย้อนกลับ </a>";
for($i=1; $i<$Num_Pages; $i++){
if($i != $Page)
echo "[<a href='$PHP_SELF?start_date=$start_date&last_date=$last_date&Page=$i'  class='text'>$i</a>]";
else 
echo "<b> $i </b>";
}
/*สร้างปุ่มเดินหน้า */
if($Page!=$Num_Pages)
echo "<a href ='$PHP_SELF?start_date=$start_date&last_date=$last_date&Page=$Next_Page'  class='text'> หน้าถัดไป>> </a>";

?></div>
</td>
</tr>
<!--
  <tr>
    <td>
	<? echo "<a href ='report_sendexcel.php?start_date=$start_date&last_date=$last_date'  class='text'>พิมพ์รายงาน ด้วย excel  </a>";  ?>
	</td>
  </tr>
-->
  <tr>
    <td>
	<? echo "&nbsp; &nbsp; &nbsp; <img src='../../images/print.gif' width=18 height=18 > <a href ='report_send.php?start_date=$start_date&last_date=$last_date'  class='text' target='_blank'>พิมพ์รายงานหนังสือออก  </a>";  ?>
	</td>
  </tr>

<?
	}
	?>

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
<script language="javascript">
function chkform()
{
	if(document.form1.start_date.value == 0)
	{
		alert("กรุณาระบุวันที่เริ่มต้น");
		document.form1.start_date.focus();
	}else
	if(document.form1.last_date.value == 0)
	{
		alert("กรุณาระบุวันที่สุดท้าย");
		document.form1.last_date.focus();
	}else
		document.form1.submit();
}

function check_number() {
e_k=event.keyCode
if (((e_k > 57) || (e_k < 47)) && e_k != 46 && e_k != 13) {
event.returnValue = false;
alert(" กรุณาระบุเป็นตัวเลขเท่านั้น");
}
} 


</script>


<? mysql_close(); 
}
  ?>