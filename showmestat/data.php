<?     
require("function/connectdb.php");
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = 'smis';
if (!$sortorder) $sortorder = 'desc';
if (!$page) $page = 1;
if (!$rp) $rp = 30;

$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";
$sort = "ORDER BY $sortname $sortorder";

$where = "";

$query = mysql_real_escape_string($_POST['query']);
$qtype = $_POST['qtype'];

if ($query) $where = " WHERE $qtype LIKE '%$query%' ";
$sql = "SELECT *  FROM sbk_showstat $where $sort $limit";
$result = runSQL($sql);
$numrow = countRec('id','sbk_showstat',$where);

if($numrow>0){
	$data['page'] = intval($page); 
	$data['total'] = intval($numrow); 
	while ($row = mysql_fetch_array($result)) {
			$rows[] = array(
					"id" => $row['id'],
					"cell" => array(
						$row['id'],
						$row['smis'],
				    	$row['schoolname'],
						$row['groupname'],
						$row['aumphur'],
						$row['numlogin'],
						$row['numsend'],
						$row['numreceive'],
						$row['statdate']
					)
				);	
	}
} else { 
     	$rows[] = array(
			"id" => 'null',
			"cell" => array(
				'null',
				'null',
				'null',
				'null',
				'null',
				'null',
				'null'
			)
		);		
}

$data['rows'] = $rows;
echo json_encode($data);
exit;
?>