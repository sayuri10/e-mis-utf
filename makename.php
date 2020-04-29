<?php 
$hostname_conn_e_mis = "localhost";
$database_conn_e_mis = "e-missive";
$username_conn_e_mis = "root";
$password_conn_e_mis = "zzz";
$conn_e_mis = mysql_pconnect($hostname_conn_e_mis, $username_conn_e_mis, $password_conn_e_mis) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RCautomname = 10;
$pageNum_RCautomname = 0;
if (isset($_GET['pageNum_RCautomname'])) {
  $pageNum_RCautomname = $_GET['pageNum_RCautomname'];
}
$startRow_RCautomname = $pageNum_RCautomname * $maxRows_RCautomname;

mysql_select_db($database_conn_e_mis, $conn_e_mis);
$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 9 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);


if (isset($_GET['totalRows_RCautomname'])) {
  $totalRows_RCautomname = $_GET['totalRows_RCautomname'];
} else {
  $all_RCautomname = mysql_query($query_RCautomname);
  $totalRows_RCautomname = mysql_num_rows($all_RCautomname);
}
$totalPages_RCautomname = ceil($totalRows_RCautomname/$maxRows_RCautomname)-1;

$queryString_RCautomname = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RCautomname") == false && 
        stristr($param, "totalRows_RCautomname") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RCautomname = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RCautomname = sprintf("&totalRows_RCautomname=%d%s", $totalRows_RCautomname, $queryString_RCautomname);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<?php
//สร้างชื่อ
$strFileName = "txt/9.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);


$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 8 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/8.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 15 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/15.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 22 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/22.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 23 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/23.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 24 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/24.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 25 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/25.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 26 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/26.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 27 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/27.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 28 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/28.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 29 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/29.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 30 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/30.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 31 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/31.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 32 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/32.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 33 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/33.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);

$query_RCautomname = "SELECT count(*) as cbr FROM sbk_sendbook where book_to = 34 and receive = 0 and status <> 0";
$RCautomname = mysql_query($query_RCautomname, $conn_e_mis) or die(mysql_error());
$row_RCautomname = mysql_fetch_assoc($RCautomname);
$strFileName = "txt/34.txt";
$objFopen = fopen($strFileName, 'w');
$strText1 = $row_RCautomname['cbr'];
fwrite($objFopen, $strText1);
fclose($objFopen);
?>
</body>
</html>
<?php
mysql_free_result($RCautomname);
?>