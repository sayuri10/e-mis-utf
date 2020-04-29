<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);

	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
			echo"<meta http-equiv='refresh' content='0;URL=../../index.php'>";
			exit(); 
} else {
?>

<html>
<head>
<title>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</title>
</head>
<body>
<form action="savegroup.php?SaveBID=<?=$_GET["sBookID"];?>" name="frmEdit" method="post">
<?
	include '../../inc/connect_db.php';


$sql4="SELECT * FROM sbk_sendbook  WHERE id = '".$_GET["sBookID"]."' ";
$query4=mysql_db_query($dbname, $sql4) or die(mysql_error()."by command".$sql4);
while($result4=mysql_fetch_array($query4)){

?>
<div align="center">
<table width="320" border="0">
  <tr>
    <th width="300"><font size="2"> <div align="center">ส่งต่อไปกลุ่มภารกิจ</div></font></th>
  
	<?
$sql1="SELECT * FROM sbk_group  WHERE (status=1) and typeID=2 and name!='สารบรรณกลาง' ";
$query1=mysql_db_query($dbname, $sql1) or die(mysql_error()."by command".$sql1);
while($result1=mysql_fetch_array($query1)){
	$sql2="SELECT * FROM sbk_location  WHERE (status=1)  and  (id='".$result1["locationID"]."')";
	//echo $sql2;
	$query2=mysql_db_query($dbname, $sql2) or die(mysql_error()."by command".$sql2);
	while($result2=mysql_fetch_array($query2)){
		$sql3="SELECT *  FROM  sbk_organize   WHERE (status=1)  and (groupID= '".$result1["id"]."') and (id<>'".$userorganize_id."') ";
		//$sql3="SELECT *  FROM  sbk_organize   WHERE (status=1)  and (groupID= '".$result1["id"]."')";
		
		$query3=mysql_db_query($dbname, $sql3) or die(mysql_error()."by -3- command".$sql3);
		while($result3=mysql_fetch_array($query3)){

		//echo "<td><input type=\"checkbox\" name=\"organize[]\"  id=\"m".$result1["id"]."_".$result2["id"]."\" value=\"".$result3["id"]."\"  >".$result3["name"]."</td>";
	//			if($cindex1%2==0){
	//				print "<td><input type=\"radio\" name=\"organize\"  value=\"".$result3["id"]."\"  >".$result3["name"]."</td></tr><tr>";
	//			}else{
					print "<tr><td><font size=\"2\"><input type=\"radio\" name=\"organize\"  value=\"".$result3["id"]."\"  >".$result3["name"]." </font></td></tr>";

	//			}
	//			$cindex1++;

		}}}

?>

  
  </table>
  <input type="submit" name="submit" value="ตกลง">
<?
  mysql_close();

}
?>
  </div>
  </form>




</body>
</html>
<?
}
?>