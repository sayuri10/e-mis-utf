<?
	session_start();
	error_reporting(E_ALL^E_NOTICE);


	if(!session_is_registered("admin_name")) {
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>กรุณา Login ก่อนใช้งานหน้านี้</b></font><br><br>";
					echo"<meta http-equiv='refresh' content='0;URL=../index.php'>";
			exit(); 
} else {
	
	include '../inc/connect_db.php';
	
	$admin_name=$_SESSION["admin_name"]; 
	$admin_id=$_SESSION["admin_id"]; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
<TITLE>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</TITLE>
<link href="mystyle.css" rel="stylesheet" type="text/css">
<? if($admin_name==''){
?>
<SCRIPT language="JavaScript">
	alert("กรุณา Login ก่อนเข้าใช้งานหน้านี้");
	window.parent.location='../admin.php';
</SCRIPT>
<? } ?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
</HEAD>
<? 
if($admin_name !=''){
echo"<FRAMESET ROWS='111,*' COLS='*' FRAMESPACING='0' FRAMEBORDER='NO' BORDER='1'>";
echo"<FRAME SRC='header_admin.php' NAME='headframe' SCROLLING='NO' NORESIZE >";
echo"<FRAMESET ROWS='*' COLS='260,*' FRAMESPACING='0' FRAMEBORDER='NO' BORDER='1'>";
echo"<FRAME SRC='sarabanmenu.php' NAME='leftframe' SCROLLING='NO' NORESIZE class='lefttext'>";
echo"<FRAME SRC='saraban/doc_receive.php' NAME='rightframe' SCROLLING='YES' NORESIZE>";
echo"</FRAMESET>";
echo"</FRAMESET>";
echo"<NOFRAMES>";
}
?>
<BODY>

</body></NOFRAMES>
</HTML>
<?
}	
?>


