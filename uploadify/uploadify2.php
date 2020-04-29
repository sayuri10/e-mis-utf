<?php
if (array_key_exists('session', $_REQUEST))
	session_id($_REQUEST['session']);
	$id2=session_id($_REQUEST['session']);
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
if (!empty($_FILES)) {

	$new_folder_name=date("Y-m-d");
	$dir_name=$_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/'.$new_folder_name;
	mkdir($dir_name,0755,true);

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/'.$new_folder_name. '/';
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
			include '../inc/connect_db.php';

	if(trim($_FILES["Filedata"]["tmp_name"]) != "")
		{

		//เช็คลำดับหนังสือออก
	$sql4="select organizeID from sbk_user  where username='".$id2."'";
	$dbquery4=mysql_db_query($dbname, $sql4);
	$result4=mysql_fetch_array($dbquery4);
	$oganID=$result4[0];




		//เช็คลำดับหนังสือออก
	$sql3="select max(bookID) from sbk_sendbook  where book_from='".$oganID."'";
	$dbquery3=mysql_db_query($dbname, $sql3);
	$result3=mysql_fetch_array($dbquery3);
	$book_send_num=$result3[0]+1;


	$sur = strrchr($_FILES['Filedata']['name'], "."); //ตัดนามสกุลไฟล์เก็บไว้
//	$newfilename = (Date("dmy_His").$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
	//เพิ่มการตั้งชื่อไฟล์
	$new_file_name1=(date("Ymd")."-".$oganID."-".$book_send_num."-2".$sur);

	$targetFile2 =  str_replace('//','/',$targetPath) . $new_file_name1 ;



//			$objConnect = mysql_connect("localhost","root","123456") or die("Error Connect to Database");
//			$objDB = mysql_select_db("of1");
//			$strSQL = "INSERT INTO picture ";
//			$strSQL .="(id,name,qid,up1) VALUES ('','".$_FILES["Filedata"]["name"]."','".$username2."','1')";
//			$objQuery = mysql_query($strSQL);
//		echo $_POST['gtype'] ;
//		echo "1";
						
		move_uploaded_file($tempFile,$targetFile2);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile2);
//		echo "1";

		//*** Insert Record ***//

		if($_FILES["Filedata"]["tmp_name"])
			{
				$sql2="select * from sbk_tmp_upload where qid='".$id2."' and up1='2' ";
				$dbquery2=mysql_db_query($dbname, $sql2);
				$numrows=mysql_num_rows($dbquery2);
	
				if($numrows <> 0)
				{
					$sql="delete from sbk_tmp_upload where qid='".$id2."' and up1='2'  ";
					$dbquery=mysql_db_query($dbname, $sql);

				}
				{
					$sql="insert into sbk_tmp_upload(id,date_upload,name,qid,up1) values( '','".$new_folder_name."','".$new_file_name1."','".$id2."','2' )";
					$dbquery=mysql_db_query($dbname, $sql);
				}
			}
			}
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
  array_map('unlink', glob("../uploads2/".$new_folder_name."/*.php"));
  array_map('unlink', glob("../uploads2/".$new_folder_name."/*.pl"));
  array_map('unlink', glob("../uploads2/".$new_folder_name."/*.py"));
  array_map('unlink', glob("../uploads2/".$new_folder_name."/*.exe"));
  array_map('unlink', glob("../uploads2/".$new_folder_name."/*.bat"));
?>