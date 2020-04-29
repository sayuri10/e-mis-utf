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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
<TITLE>ระบบรับ-ส่งหนังสือราชการ : Transmission Missive System</TITLE>
<link href="mystyle.css" rel="stylesheet" type="text/css">
<? if($username2==''){
?>
<SCRIPT language="JavaScript">
	alert("กรุณา Login ก่อนเข้าใช้งานหน้านี้");
	window.parent.location='index.php';
</SCRIPT>
<? } ?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
</HEAD>
<? 
if($username2 !=''){
echo"<FRAMESET ROWS='111,*' COLS='*' FRAMESPACING='0' FRAMEBORDER='NO' BORDER='1'>";
echo"<FRAME SRC='header_admin.php' NAME='headframe' SCROLLING='NO' NORESIZE >";
echo"<FRAMESET ROWS='*' COLS='260,*' FRAMESPACING='0' FRAMEBORDER='NO' BORDER='1'>";
echo"<FRAME SRC='usermenu.php' NAME='leftframe' SCROLLING=YES' NORESIZE class='lefttext'>";
echo"<FRAME SRC='doc_receive.php' NAME='rightframe' SCROLLING='YES' NORESIZE>";
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