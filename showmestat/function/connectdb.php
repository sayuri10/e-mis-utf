<?php
error_reporting(0);
//	include '../../inc/connect_db.php';

function runSQL($rsql) {
	require( "../inc/connect_db.php");
	$connect = mysql_connect($hostname,$user,$password) or die ("Error: could not connect to database");
	mysql_query("SET NAMES utf8",$connect);

	$db = mysql_select_db($dbname);
	$result = mysql_query($rsql) or die ('Error: could not query data'); 
	return $result;
	mysql_close($connect);
}

function countRec($fname,$tname,$where) {
	$sql = "SELECT count($fname) FROM $tname $where";
	$result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) {
		return $row[0];
	}
}
?>