<?
include 'inc/connect_db.php';

	$monthname=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;
	$showtodaydate_db= date("Y-m-d");
//แปลงวันที่ไทย

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
	background-color: #E5E5E5;
}
-->
</style></head>


<table width="100%" border="0" cellspacing="3" cellpadding="2">
      <tr>
        <td class="bg_colorCopy"><img src="images/report.gif" width="16" height="16" align="absmiddle" /> ข่าวประกาศ </td>
      </tr>
      <tr>
        <td>
		<table width="100%" height="25" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#999999" bordercolordark="#FFFFFF">
		  <?
				
				$num=1;
		  		$sql2="select * from sbk_news where end_date>='$showtodaydate_db'  order by id desc";
				$dbquery2=mysql_db_query($dbname, $sql2);
				
				while($result2=mysql_fetch_array($dbquery2))
				{
					$news_id=$result2[id];
					$news_start_date=$result2[start_date];
					$news_end_date=$result2[end_date];
					$news_detail=$result2[detail];
					$news_status=$result2[status];
					$news_userID=$result2[userID];

					//หาชื่อหน่วยงาน
						$sql67="select organizeID from sbk_user where  user_id='$news_userID' ";
						$db_query67=mysql_db_query($dbname,$sql67);
					while($result67 = mysql_fetch_array($db_query67))
					{
							$orgID=$result67[0];								
					}
						$sql77="select name from sbk_organize where id='$orgID' ";
						$db_query77=mysql_db_query($dbname,$sql77);
					while($result77 = mysql_fetch_array($db_query77))
					{
							$name_news_post="".$result77[0]."";								
					}


					$news_start_date_th=thai_date($news_start_date);
					$news_end_date_th=thai_date($news_end_date);


					if($bg == "#DFE6F1") { //ส่วนของการ สลับสี 
					$bg = "#F8F7DE";
					} else {
					$bg = "#DFE6F1";
					}
						//แสดงสถานนะหนังสือ
					if($showtodaydate_db<=$news_end_date) { $status_news="ประกาศอยู่";  }
					else{ $status_news="หมดเวลา"; $bg = "#A6A6A6";  }
						$news_detail=htmlspecialchars($news_detail);
					echo"<tr class='text' bgcolor='$bg' valign=\"center\">
						<td align=\"left\"> &nbsp; <img src=\"images/speaker.gif\"> : $news_detail โดย $name_news_post ($news_start_date_th) </td>
							</tr>";
					$num++;
				}
		  ?>
        </table></td>
      </tr>
    </table><br>
	

</body>
</html>
