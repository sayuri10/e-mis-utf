<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>เธฃเธฐเธเธเธฃเธฑเธ-เธชเนเธเธซเธเธฑเธเธชเธทเธญเธฃเธฒเธเธเธฒเธฃ : Transmission Missive System</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/stylesheet.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="plugin/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="plugin/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="plugin/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="plugin/flexigrid/css/flexigrid.css" />
<script type="text/javascript" src="plugin/flexigrid/js/flexigrid.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#flex1").flexigrid({
			url: 'data.php',
			dataType: 'json',
			colModel : [
				{display: 'ID', name : 'id', width : 30, sortable : true, align: 'center'},
				{display: 'SMIS', name : 'smis', width : 70, sortable : true, align: 'center'},
				{display: 'เนเธฃเธเน€เธฃเธตเธขเธ', name : 'schoolname', width : 180, sortable : true, align: 'left'},
				{display: 'เน€เธเธฃเธทเธญเธเนเธฒเธข', name : 'groupname', width : 120, sortable : true, align: 'left'},
				{display: 'เธญเธณเน€เธ เธญ', name : 'aumphur', width : 80, sortable : true, align: 'left', hide: true},
				{display: 'เน€เธเนเธฒเธฃเธฐเธเธ(เธเธฃเธฑเนเธ)', name : 'numlogin', width : 80, sortable : true, align: 'right'},
				{display: 'เธชเนเธเธซเธเธฑเธเธชเธทเธญ(เธเธฃเธฑเนเธ)', name : 'numsend', width : 80, sortable : true, align: 'right'},
				{display: 'เธฃเธฑเธเธซเธเธฑเธเธชเธทเธญ(เธเธฃเธฑเนเธ)', name : 'numreceive', width : 80, sortable : true, align: 'right'},
				{display: 'เธเนเธญเธกเธนเธฅเธงเธฑเธเธ—เธตเน', name : 'statdate', width : 80, sortable : true, align: 'center', hide: true}
				],
			searchitems : [
				{display: 'เน€เธเธฃเธทเธญเธเนเธฒเธข', name : 'groupname'},
				{display: 'เธญเธณเน€เธ เธญ', name : 'aumphur'},
				{display: 'เนเธฃเธเน€เธฃเธตเธขเธ', name : 'schoolname', isdefault: true}
				],
			sortname: "smis",
			sortorder: "asc",
			usepager: true,
			title: 'เธเนเธญเธกเธนเธฅเธชเธ–เธดเธ•เธดเธเธฒเธฃเนเธเนเธเธฒเธเธฃเธฐเธเธ E-Missive ',
			useRp: true,
			rp: 30,
			showTableToggleBtn: true,
			width: 800,
			height: 794
		});   
});
</script>
</head>
<body>
<?
	include '../inc/connect_db.php';

	//เธงเธฑเธเธ—เธตเน
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y")+543;
	$showtodaydate=$curDay."-".$curMonth."-".$curYear ;

$statdate_old='';
//เธ•เธฃเธงเธเธชเธญเธเธงเธฑเธเธ—เธตเน
		$sql8="SELECT statdate FROM sbk_showstat ";
		$query8=mysql_db_query($dbname, $sql8) or die(mysql_error()."by command".$sql8);
			while($result8=mysql_fetch_array($query8)){
			$statdate_old=$result8[0];
			}
	if($statdate_old==''){
			echo "<script language=\"javascript\">
		alert(\"เนเธกเนเธกเธตเธเนเธญเธกเธนเธฅเธเธฃเธฑเธ\");
		window.location='../index.php';
	</script>";
	}else if($statdate_old!='$showtodaydate'){

//เธฅเธเธชเธ–เธดเธ•เธดเน€เธเนเธฒเธเนเธญเธเธเธฐ
		$sql="delete from sbk_showstat ";
		$dbquery=mysql_db_query($dbname, $sql);

//เธเธฅเธธเนเธกเน€เธเธฃเธทเธญเธเนเธฒเธข
		$sql1="SELECT * FROM sbk_group  WHERE (status=1)  order by typeID desc ,id";
		$query1=mysql_db_query($dbname, $sql1) or die(mysql_error()."by command".$sql1);
			while($result1=mysql_fetch_array($query1)){
			$group_name=$result1["name"];

//เธญเธณเน€เธ เธญ
			$sql6="select name FROM sbk_location  WHERE (status=1)  and  (id='".$result1["locationID"]."')  ";
			$dbquery6=mysql_db_query($dbname, $sql6);
			$result6=mysql_fetch_array($dbquery6);
			$location_name=$result6[0];

//เธเธทเนเธญเธซเธเนเธงเธขเธเธฒเธ
	$sql2="SELECT * FROM sbk_organize  WHERE (status=1)  and (groupID= '".$result1["id"]."')  ";
	$query2=mysql_db_query($dbname, $sql2) or die(mysql_error()."by command".$sql2);
	while($result2=mysql_fetch_array($query2)){
		$sum_count_login=0;
		$organize_name=$result2["name"];
		$organize_smis=$result2["smis"];
		$organize_id=$result2["id"];
		
//เธเธณเธเธงเธ Login
		$sql3="SELECT * FROM sbk_user  WHERE (status=1) and (organizeID = '".$result2["id"]."')  ";
		$query3=mysql_db_query($dbname, $sql3) or die(mysql_error()."by command".$sql3);
		while($result3=mysql_fetch_array($query3)){
					$sum_count_login=$sum_count_login+$result3["count_login"];
				}

//เธเธณเธเธงเธเธชเนเธเธซเธเธฑเธเธชเธทเธญ
			$sql4="select max(send_num) from sbk_book where book_from='".$result2["id"]."' ";
			$dbquery4=mysql_db_query($dbname, $sql4);
			$result4=mysql_fetch_array($dbquery4);
			$book_send_num=$result4[0];

//เธเธณเธเธงเธเธฃเธฑเธเธซเธเธฑเธเธชเธทเธญ				
			$sql5="select max(receive) from sbk_sendbook where book_to='".$result2["id"]."' and receive<>0 ";
			$dbquery5=mysql_db_query($dbname, $sql5);
			$result5=mysql_fetch_array($dbquery5);
			$book_receive_num=$result5[0];

//เธชเธฃเนเธฒเธเธเธฒเธเธเนเธญเธกเธนเธฅ			
			$sql7="insert into sbk_showstat (id, smis, schoolname,groupname,aumphur, numlogin, numsend, numreceive , statdate ,status) values('$organize_id', '$organize_smis', '$organize_name', '$group_name' , '$location_name', '$sum_count_login', '$book_send_num', '$book_receive_num' , '$showtodaydate','')";
			$dbquery7=mysql_db_query($dbname, $sql7) or die(mysql_error()." by command ".$sql7);

//เธ—เธ”เธชเธญเธ Error
//echo "$sql7 <br>$group_name <br>$location_name<br>$organize_name<br>$organize_id<br>$organize_smis<br>$sum_count_login<br>$book_send_num<br>$book_receive_num<br><br><br>  ";

			}   //เธเธเธชเธฃเนเธฒเธเธซเธเนเธงเธขเธเธฒเธ
		
			}   //เธเธเธชเธฃเนเธฒเธเธเธฅเธธเนเธก


	}

?>


	<table id="flex1" style="display:none"></table>




</body>
</html>