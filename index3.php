<?	session_start();session_destroy();error_reporting(E_ALL^E_NOTICE);
?>
<? 
	$monthname=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
?>
<?
	$curDay = date("j");
	$curMonth = date("n");
	$curYear = date("Y")+543;
	$year=date("Y");
	
	//$today="$curDay-$curMonth-$curYear";
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

<? $today="$curDay $showmonth $curYear"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="stats-in-th" content="5f4b" />

<link href="mystyle.css" rel="stylesheet" type="text/css" />
 <link href="tooltip/themes/2/tooltip.css" rel="stylesheet" type="text/css" />
    <script src="tooltip/themes/2/tooltip.js" type="text/javascript"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><? include 'header.php'; ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15%" valign="top" bgcolor="#CCCCCC" class="right_border"><table width="260" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><? include 'menu.php'; ?></td>
          </tr>
        </table></td>
        <td width="85%" valign="top" bgcolor="#E5E5E5"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?  include'show_news.php'; ?></td>
          </tr>
          <tr>
            <td>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div align="center" class="title">:: รายการส่งหนังสือราชการของ อำเภอ <?=$Page_index;?> รายการล่าสุด  ::</div></td>
              </tr>
              <tr>
                <td><div align="center" class="title">---------------------------------------------------- </div></td>
              </tr>
              <tr>
                <td><div align="center" class="title"><a href="index.php">:: เลือกหนังสือทุกหน่วยงาน  ::</a><a href="index2.php">:: เลือกหนังสือจากจังหวัด  ::</a><a href="index3.php">::  เลือกหนังสือจากอำเภอ  :: </a></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>


        <td><table width="98%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
          <tr class="title_table_green">
            <td width="60">ที่</td>
            <td width="82">วันที่ส่ง</td>
            <td width="25"><IMG SRC="images/priority/5.gif" BORDER="0"  width=17 height=12 alt="ความสำคัญ" ></td>
            <td width="350">เรื่อง</td>
            <td width="150">จาก</td>
            <td width="135">ถึง | รับ</td>
          </tr>
		  <?
		  		$sql="select * from sbk_book where from_type=1 Order by id desc  LIMIT 0 , $Page_index ";

				$dbquery=mysql_db_query($dbname, $sql);
				
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
				
					//แสดงรายละเอียดหนังสือ
					$book_detail_id=$all_id;

					$count_file=0;
					if($all_file1<>'')$count_file++;
					if($all_file2<>'')$count_file++;
					if($all_file3<>'')$count_file++;
					if($all_file4<>'')$count_file++;
					if($all_file5<>'')$count_file++;
					if($count_file <>0) {$count_file='<img src="images/file.gif"  width="16" height="16" align="absmiddle" >';}
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
							$count_tosend=$result5[0]." แห่ง ";		
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
							$status_receive=$num_receive." ";
						}



//to2n หาผู้รับ
$arr = array("","","","","","","","","","","","","",""); 
$name_tosend="";
$sql_to="select * from sbk_sendbook where bookID=$book_detail_id ";
						$db_query_to=mysql_db_query($dbname,$sql_to);
					while($result_to = mysql_fetch_array($db_query_to))
					{
							$to_id=$result_to[book_to];	
							$to_received=$result_to[receive];	
							$to_rec=$result_to[date_receive];
						$sql_org_to="select name,num_book from sbk_organize where id=$to_id ";
						$db_query_org_to=mysql_db_query($dbname,$sql_org_to);
					while($result_org_to = mysql_fetch_array($db_query_org_to))
					{
							//$name_tosend=$result_org_to[0];
							/*if($to_received==0){
					  					$name_tosend = $name_tosend."<font color=red>".$result_org_to[0]."<br/>"; 
							}else{
										$name_tosend = $name_tosend."<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>"; 
							}*/
							
							
							switch (intval(substr($result_org_to[1],14,3))) {
												case 1:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 2:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 3:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 4:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 5:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 6:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 7:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 8:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 9:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 10:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 11:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 12:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 13:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
												case 14:
													if($to_received==0){
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=red>".$result_org_to[0]."<br/>";
													}else{
														$arr[intval(substr($result_org_to[1],14,3))-1]="<font color=darkgreen>".$result_org_to[0]."[".$to_rec."]</font><br/>";
														}
													break;
											}
															
							
					}
					
					
					}
																	foreach($arr as $show){  
																				//echo $show." "; // output one two three four five  
																				$name_tosend = $name_tosend.$show;
																			}  
				  
  
					//to2n



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
					//$bg = "#ffaaaa";
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
							$status_edit="<a href='cancel_book.php?cancel_book_id=$allsend_id' class='textnormal'>ยกเลิก </a>";
						}
					//แสดงผล
					
					
					
					
					/*echo"<tr class='text' bgcolor='$bg'>
						<td align='center'>$all_id</td>
						<td align='center'>$thai_date_post</td>
						<td align='center'><IMG SRC=\"images/priority/$imgShowPiority\" BORDER=\"0\"  width=14 height=11 alt=\"$priority_name\" ></td>
						<td >&nbsp;$all_book_title</td>
						<td align='center'>$name_book_from </td>
						<td align='center'>$status_book | $status_receive</td>
					</tr>";*/
					?>
					<tr class='text' bgcolor='<? echo $bg; ?>'>
						<td align='center'><? echo $all_id;?></td>
                        <? if (thai_date(now)==$thai_date_post) {?>
						<td align='center'><img src="images/new.png" align="texttop"><? echo $thai_date_post;?></td>
                        <? } else {?>
                        <td align='center'><? echo $thai_date_post;?></td>
                        <? } ?>
						<td align='center'><IMG SRC="images/priority/<? echo $imgShowPiority;?>" BORDER="0"  width=14 height=11 alt="<? echo $priority_name;?>" ></td>
						<td >&nbsp;<span class="tooltip" onMouseOver="tooltip.pop(this, '<h3>สถานะการรับหนังสือ</h3><? echo $name_tosend;?>')"><? echo $all_book_title;?></span></td>
						<td align='center'><? echo $name_book_from;?></td>
						<td align='center'><? echo $status_book;?>|<? echo $status_receive;?></td>
					</tr>
					<?
					
					
					
					
					
					
				}
	//			echo $sql8;
		
		  
		  
		  ?>
        </table>
</td>
              </tr>

            </table>
			
</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><? include 'footer.php'; ?></td>
        </tr>
    </table></td>
  </tr>
</table>


</body>
</html>
<? mysql_close(); ?>