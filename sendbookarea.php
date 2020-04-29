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
	include "inc/connect_db.php";
	
//ลบไฟล์ในตาราง temp
		$sql10="delete  from sbk_tmp_upload where qid='".$username2."' ";
		$dbquery10=mysql_db_query($dbname, $sql10);


  //แก้เขตพื้นที่ไม่ต้องส่งให้เขตพื้นที่
				//หากลุ่มหน่วยงาน
				$sql7="select groupID from sbk_organize where id=$userorganize_id ";
				$db_query7=mysql_db_query($dbname,$sql7);
					while($result7 = mysql_fetch_array($db_query7))
					{
							$group_id="".$result7[0]."";								
					}
				//หาประเภทหน่วยงาน
				$sql1="select typeID from sbk_group where id=$group_id ";
				$db_query1=mysql_db_query($dbname,$sql1);
					while($result1 = mysql_fetch_array($db_query1))
					{
							$type_id="".$result1[0]."";								
					}
			if($type_id==1)   //ถ้าเป็นโรงเรียนให้แสดง
				{



?>
<? 
	$monthname=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
?>
<?
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
<!-- อัพโหลดแบบเทพ -->
<link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="uploadify/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">
	var maxQueueSize = 5;
	var queueSize = 0;
  $(document).ready(function() {
//เพิ่มตัวแปร
	$('#gtype').change(function(){
	$('#uploadify').uploadifySettings('scriptData', {'gtype' : $('#gtype').val()});
   });
//แนบไฟล์1
  $('#file_upload').uploadify({
    'uploader'  : 'uploadify/uploadify.swf',
    'script'    : 'uploadify/uploadify.php',
    'cancelImg' : 'uploadify/cancel.png',
    'folder'    : 'uploads2',
    'multi'	  :  false,
	'displayData': 'percentage',
    'auto'      : true,
	'removeCompleted'	:	false ,
	'fileDataName'	:	'Filedata',
	'buttonText'	:	'Select...File 1',
	'queueSizeLimit' : 1 ,
	'buttonImg'   : 'images/file_upload.gif',
	'height'          : 38, // The height of the flash button
	'width'           : 150, // The width of the flash button
	'scriptData' : { 'session': '<? echo $_SESSION["username2"]?>'},		

		onCancel: function (evt, queueID, fileObj, response, data) {
			queueSize--;
		},
		onClearQueue: function (evt, queueID, fileObj, response, data) {
			queueSize = 0; // Changed from b.fileCount to 0 (as it'll remove everything from queue)
		},
		onSelect: function (evt, queueID, fileObj, response, data) {
			if (queueSize < maxQueueSize) {
				queueSize++;
			} else {
				return false;
			}		
		}
  });

//แนบไฟล์2
  $('#file_upload2').uploadify({
    'uploader'  : 'uploadify/uploadify.swf',
    'script'    : 'uploadify/uploadify2.php',
    'cancelImg' : 'uploadify/cancel.png',
    'folder'    : 'uploads2',
    'multi'	  :  false,
	'displayData': 'percentage',
    'auto'      : true,
	'removeCompleted'	:	false ,
	'fileDataName'	:	'Filedata',
	'buttonText'	:	'Select...File 2',
	'queueSizeLimit' : 1 ,
	'buttonImg'   : 'images/file_upload2.gif',
	'height'          : 38, // The height of the flash button
	'width'           : 150, // The width of the flash button
	'scriptData' : { 'session': '<? echo $_SESSION["username2"]?>'},		
		onCancel: function (evt, queueID, fileObj, response, data) {
			queueSize--;
		},
		onClearQueue: function (evt, queueID, fileObj, response, data) {
			queueSize = 0; // Changed from b.fileCount to 0 (as it'll remove everything from queue)
		},
		onSelect: function (evt, queueID, fileObj, response, data) {
			if (queueSize < maxQueueSize) {
				queueSize++;
			} else {
				return false;
			}		
		}
  });
//แนบไฟล์3
  $('#file_upload3').uploadify({
    'uploader'  : 'uploadify/uploadify.swf',
    'script'    : 'uploadify/uploadify3.php',
    'cancelImg' : 'uploadify/cancel.png',
    'folder'    : 'uploads2',
    'multi'	  :  false,
	'displayData': 'percentage',
    'auto'      : true,
	'removeCompleted'	:	false ,
	'fileDataName'	:	'Filedata',
	'buttonText'	:	'Select...File 3',
	'queueSizeLimit' : 1 ,
	'buttonImg'   : 'images/file_upload3.gif',
	'height'          : 38, // The height of the flash button
	'width'           : 150, // The width of the flash button
	'scriptData' : { 'session': '<? echo $_SESSION["username2"]?>'},		
		onCancel: function (evt, queueID, fileObj, response, data) {
			queueSize--;
		},
		onClearQueue: function (evt, queueID, fileObj, response, data) {
			queueSize = 0; // Changed from b.fileCount to 0 (as it'll remove everything from queue)
		},
		onSelect: function (evt, queueID, fileObj, response, data) {
			if (queueSize < maxQueueSize) {
				queueSize++;
			} else {
				return false;
			}		
		}
  });
//แนบไฟล์4
  $('#file_upload4').uploadify({
    'uploader'  : 'uploadify/uploadify.swf',
    'script'    : 'uploadify/uploadify4.php',
    'cancelImg' : 'uploadify/cancel.png',
    'folder'    : 'uploads2',
    'multi'	  :  false,
	'displayData': 'percentage',
    'auto'      : true,
	'removeCompleted'	:	false ,
	'fileDataName'	:	'Filedata',
	'buttonText'	:	'Select...File 4',
	'queueSizeLimit' : 1 ,
	'buttonImg'   : 'images/file_upload4.gif',
	'height'          : 38, // The height of the flash button
	'width'           : 150, // The width of the flash button
	'scriptData' : { 'session': '<? echo $_SESSION["username2"]?>'},		
		onCancel: function (evt, queueID, fileObj, response, data) {
			queueSize--;
		},
		onClearQueue: function (evt, queueID, fileObj, response, data) {
			queueSize = 0; // Changed from b.fileCount to 0 (as it'll remove everything from queue)
		},
		onSelect: function (evt, queueID, fileObj, response, data) {
			if (queueSize < maxQueueSize) {
				queueSize++;
			} else {
				return false;
			}		
		}
  });
//แนบไฟล์5
  $('#file_upload5').uploadify({
    'uploader'  : 'uploadify/uploadify.swf',
    'script'    : 'uploadify/uploadify5.php',
    'cancelImg' : 'uploadify/cancel.png',
    'folder'    : 'uploads2',
    'multi'	  :  false,
	'displayData': 'percentage',
    'auto'      : true,
	'removeCompleted'	:	false ,
	'fileDataName'	:	'Filedata',
	'buttonText'	:	'Select...File 5',
	'queueSizeLimit' : 1 ,
	'buttonImg'   : 'images/file_upload5.gif',
	'height'          : 38, // The height of the flash button
	'width'           : 150, // The width of the flash button
	'scriptData' : { 'session': '<? echo $_SESSION["username2"]?>'},		
		onCancel: function (evt, queueID, fileObj, response, data) {
			queueSize--;
		},
		onClearQueue: function (evt, queueID, fileObj, response, data) {
			queueSize = 0; // Changed from b.fileCount to 0 (as it'll remove everything from queue)
		},
		onSelect: function (evt, queueID, fileObj, response, data) {
			if (queueSize < maxQueueSize) {
				queueSize++;
			} else {
				return false;
			}		
		}
  });


});
</script>
<!-- จบละ  -->
<link href="mystyle.css" rel="stylesheet" type="text/css" />
<script language='javascript' src='popcalendar.js'></script>
	<!--    เลือกหน่วยงานหลายๆ..หน่วยงาน     --->
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	function GroupChange(objcheck,idorganize){
		//alert(objcheck.checked);
		if(objcheck.checked==true){
			if(idorganize.length){
			 for (i=0; i < idorganize.length; i++){
				  idorganize[i].checked=true;
			  }
			}else{
				idorganize.checked=true;
			}
		}else{
			if(idorganize.length){
			 for (i=0; i < idorganize.length; i++){
				  idorganize[i].checked=false;
			  }
			}else{
				idorganize.checked=false;
			}
		}
	}
	//-->
	</SCRIPT>

	<!-- ปฏิทินภาษาไทย Datepicker  -->
		<link type="text/css" href="DatePicker/css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="DatePicker/js/jquery-ui-1.8.1.offset.datepicker.min.js"></script>
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


<style type="text/css">
<!--
body {
	margin-top: 20px;
	background-color: #E5E5E5;
}
-->
</style>

<!--ส่งให้สารบรรณ-->
<script type="text/javascript">

function showsaraban(val)
{
if(val==true)
{
document.getElementById("showsaraban").style.display="";
}
else
{
document.getElementById("showsaraban").style.display="none";
}
}
	</SCRIPT>
</head>

<body>
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

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title_bg_text_no_center_blue"><img src="images/application_add.gif" width="16" height="16" align="absmiddle" /> บันทึกส่งหนังสือราชการไป สำนักงาน กศน.จังหวัด</td>
  </tr>
<!--</table>-->
<tr><td>

<form action="add-bookarea.php" name="form1" method="post">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="5" class="borderall_green">
  
  <tr>
    <td width="16%" class="blue_bg_color"><div align="right"><strong>วันที่ส่ง : </strong></div></td>
    <td width="84%" class="yellow_bg_color"><? echo "$showtodaydate"; ?></td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>ลำดับหนังสือ : </strong></div></td>
    <td class="yellow_bg_color">
<?
	//เช็คลำดับหนังสือออก
	$sql3="select max(send_num) from sbk_book  where book_from='$userorganize_id'";
	$dbquery3=mysql_db_query($dbname, $sql3);
	$result3=mysql_fetch_array($dbquery3);
	$book_send_num=$result3[0]+1;
	
	echo  "".$book_send_num." / ".$curYear."";
?>	
	<input name="send_num" type="hidden" id="send_num" size="40" value="<?=$book_send_num;?>" /> 
      </td>
  </tr>
<tr>
    <td class="blue_bg_color"><div align="right"><strong>ความสำคัญ : </strong></div></td>
    <td class="yellow_bg_color">
			  <select name="priority" id="priority" width="40">
					<?php
						$sql="select * from sbk_priority where status=1 order by  id ";
						$db_query=mysql_db_query($dbname,$sql) or die(mysql_error()."by command".$sql);
					while($result = mysql_fetch_array($db_query))
					{
							$priority_id=$result["id"];
							$priority_name=$result["name_priority"];
							echo   "<option value=\"$priority_id\"> $priority_name </option> \n";
         			}
					mysql_close($dbname);
				?>
      </select>
      <span class="redfont">*</span> </td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>เลขที่หนังสือ : </strong></div></td>
    <td class="yellow_bg_color">
				<?php
						$sql3="select * from sbk_organize where id=".$userorganize_id."  ";
						$db_query3=mysql_db_query($dbname,$sql3) or die(mysql_error()."by command".$sql);
					while($result3 = mysql_fetch_array($db_query3))
					{
							$organize_numbook=$result3["num_book"];
         			}
				?>
		<input name="doc_num" type="text" id="doc_num" size="40" value="<? echo $organize_numbook;?>/" /> 
      <span class="redfont">*</span> </td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>ลงวันที่ : </strong></div></td>
    <td class="yellow_bg_color"><input name="date_doc" type="text" id="datepicker-th" size="40" /> 
      <span class="redfont">*</span> </td>
  </tr>
  <tr>
    <td class="blue_bg_color"><div align="right"><strong>เรื่อง : </strong></div></td>
    <td class="yellow_bg_color"><input name="titlesubject" type="text" id="titlesubject" size="80" /> 
      <span class="redfont">*</span> </td>
  </tr>
  <tr>
    <td class="blue_bg_color" valign="top"><div align="right" ><strong>รายละเอียด : </strong></div></td>
    <td class="yellow_bg_color"><textarea name="detail" cols="80" rows="5" id="detail"></textarea> 
       </td>
  </tr>
 <tr>
    <td class="blue_bg_color"  valign="top"><div align="right"><strong>ไฟล์แนบ : </strong></div></td>
    <td class="yellow_bg_color">


 
	 <!-- &nbsp;&nbsp; <font color=red> ** แนบไฟล์ได้ไม่เกิน 5 ไฟล์  </font><br> -->
	 &nbsp;&nbsp; <input id="file_upload" name="file_upload" type="file" />
<!--	<a href="javascript:$('#file_upload').uploadifyUpload()"> อัพโหลดไฟล์แนบ </a> |  <a href="javascript:$('#file_upload').uploadifyClearQueue()"> ยกเลิกการอัพโหลด </a>  -->
	<br> &nbsp;&nbsp; <input id="file_upload2" name="file_upload2" type="file" />
	<br> &nbsp;&nbsp; <input id="file_upload3" name="file_upload3" type="file" />
	<br> &nbsp;&nbsp; <input id="file_upload4" name="file_upload4" type="file" />
	<br> &nbsp;&nbsp; <input id="file_upload5" name="file_upload5" type="file" />

       </td>
  </tr>
  <tr>
    <td class="blue_bg_color" valign="top"><div align="right"><strong>หน่วยงานที่รับ : </strong></div></td>
    <td class="yellow_bg_color">
<!-- เลือกหน่วยงาน -->
<TABLE border=0 cellpadding=0 cellspacing=1 width="100%" bordercolor="#99FF00">
<TR bgcolor="#00CCCC">
	<TH width="150"><FONT COLOR="#000000">สำนักงาน</FONT></TH>
	<TH width="80%"><FONT COLOR="#000000">หน่วยงาน</FONT></TH>
</TR>
<?
print $arrSchoolmember;
$sql1="";//Query amphure
$sql2="";//query tambon
$sql3="";//query school members

$cindex=0;
$cindex1=1;
$CheckstateBegin="checked";
echo"<TR bgcolor=\"".$TRbgcolorBookformal[$cindex]."\">";
echo"	<Td width=\"150\">";
echo " &nbsp;<b>สำนักงาน กศน.จังหวัด</b></td><td>";
echo"<table width=\"80%\" border=0 ><tr>"; 

	$sql_saraban="select id from sbk_organize  where name='สารบรรณกลาง' ";
	$dbquery_saraban=mysql_db_query($dbname, $sql_saraban);
	$result_saraban=mysql_fetch_array($dbquery_saraban);
	$id_saraban=$result_saraban[0];

echo "<td colspan=\"3\"><input type=\"radio\" name=\"organize[]\"  id=\"msaraban\" value=\"".$id_saraban."\"  checked> สารบรรณกลาง </td></tr><tr>";
/* to2n beg
$sql1="SELECT * FROM sbk_group  WHERE (status=1) and typeID=2 and name!='สารบรรณกลาง' ";
$query1=mysql_db_query($dbname, $sql1) or die(mysql_error()."by command".$sql1);
while($result1=mysql_fetch_array($query1)){
	$sql2="SELECT * FROM sbk_location  WHERE (status=1)  and  (id='".$result1["locationID"]."')";
	$query2=mysql_db_query($dbname, $sql2) or die(mysql_error()."by command".$sql2);
	while($result2=mysql_fetch_array($query2)){
		$sql3="SELECT *  FROM  sbk_organize   WHERE (status=1)  and (groupID= '".$result1["id"]."') and (id<>'".$userorganize_id."') ";
		$query3=mysql_db_query($dbname, $sql3) or die(mysql_error()."by command".$sql3);
		while($result3=mysql_fetch_array($query3)){

		//echo "<td><input type=\"checkbox\" name=\"organize[]\"  id=\"m".$result1["id"]."_".$result2["id"]."\" value=\"".$result3["id"]."\"  >".$result3["name"]."</td>";
				if($cindex1%2==0){
					print "<td><input type=\"radio\" name=\"organize[]\"  id=\"m".$result1["id"]."_".$result2["id"]."\" value=\"".$result3["id"]."\"  >".$result3["name"]."</td></tr><tr>";
				}else{
					print "<td><input type=\"radio\" name=\"organize[]\"  id=\"m".$result1["id"]."_".$result2["id"]."\" value=\"".$result3["id"]."\"  >".$result3["name"]." </td>";
				}
				$cindex1++;

		}}}
//echo "</div>";

to2n end*/
	echo"</tr></table></Td>";
	echo"</TR>";
?>
</TABLE>
</td>
  </tr>

  <tr>
    <td class="blue_bg_color"><div align="right"><strong> ผู้ส่งหนังสือ : </strong></div></td>
    <td class="yellow_bg_color"> <font color="#336666">
	<input name="sendfrom" type="hidden" id="sendfrom" value="<? echo $userorganize_id; ?>" />
	<b> 
	<? 
	
	$sql="select name from sbk_organize where id=$userorganize_id";
	$dbquery=mysql_db_query($dbname, $sql);
	$result=mysql_fetch_array($dbquery);
	$nameorganize=$result[0];
	echo $nameorganize; 
	?>
	</b></font></td>
  </tr>
  <tr>
    <td class="blue_bg_color">&nbsp;</td>
    <td class="yellow_bg_color"><input type="button" name="Button" value="ส่งหนังสือราชการ" onclick="chkform();"/> <input type="reset" name="Submit2" value="ยกเลิกการส่ง" /></td>
  </tr>
 <tr>
    <td class="blue_bg_color">&nbsp;</td>
    <td class="yellow_bg_color"><font color="red">*ก่อนคลิ๊กส่งหนังสือกรุณาตรวจสอบไฟล์แนบก่อนว่าอัพโหลดเสร็จหรือไม่ ถ้าเสร็จแล้วครบ(100%)จะขึ้นคำว่า "Completed" <br>
	หากแนบไฟล์ไม่ได้ให้ลองใช้ web browser อื่นๆ เช่น Chrome , IE8 หรือ Firefox  สามารถดาวน์โหลดได้ที่หน้าแรกของระบบ</font></td>
  </tr>
</table>
</form>
</td></tr></table>

</body>
</html>
<script language="javascript">
function chkform()
{
	if(document.form1.titlesubject.value == 0)
	{
		alert("กรุณาระบชื่อเรื่องหนังสือราชการ");
		document.form1.titlesubject.focus();
	}else
	if(document.form1.date_doc.value == 0)
	{
		alert("กรุณาระบุเลขวันที่หนังสือส่ง");
		document.form1.date_doc.focus();
	}else
	if(document.form1.doc_num.value == 0)
	{
		alert("กรุณาระบุเลขที่หนังสือส่ง");
		document.form1.doc_num.focus();
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
<?
}  //เช็คถ้าเป็นเขตไม่ต้องส่งให้เขต

}
	?>