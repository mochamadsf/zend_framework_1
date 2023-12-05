<?php

class Application_Model_Index extends Zend_Db_Table_Abstract
{

	function __construct()
	{
		$params = array('username' => 'root', 'password' => '', 'host' => 'localhost', 'dbname' => 'tesx');

		try {
			$this->_db = Zend_Db::factory('Mysqli', $params);
			$this->_db->getConnection();
		} catch (Zend_Db_Adapter_Exception $e) {
			echo $e;
		} catch (Zend_Exception $e) {
			echo $e;
		}
	}
	
	public function user_list()
	{

		$sql = "SELECT distinct(NAMA) FROM USERLIST";
		try {
			$data = $this->_db->fetchAll($sql);
			return $data;

			//Zend_Debug::dump($data); die($sql);
		} catch (Exception $e) {
			Zend_Debug::dump($e);
			die();
		}
	}

	function get_list_tabletes() {
		$aColumns = array(
			'ID',
			'FIRST_NAME',
			'LAST_NAME',
			'EMAIL',
			'GENDER'
);
					
		$sLimit = "";
if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
{
	$first =  $_POST['iDisplayStart']+1;
	$last = $_POST['iDisplayStart'] + $_POST['iDisplayLength'];

	$sLimit = " AND nomor BETWEEN ".$first." AND ".$last." ";
}

$sOrder = "";
if (isset ( $_POST ['iSortCol_0'] ) && intval ( $_POST ['iSortCol_0'] ) > 0) {
	$sOrder = "ORDER BY  ";
	for($i = 1; $i < intval ( $_POST ['iSortingCols'] ); $i ++ )
	{ 

		if ($_POST ['bSortable_' . intval ( $_POST ['iSortCol_' . $i] )] == "true") {
			$sOrder .= "a." . $aColumns [intval ( $_POST ['iSortCol_' . $i] )] . " " . ($_POST ['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
		}
	}
	
	$sOrder .= "a." . $aColumns [intval ( $_POST ['iSortCol_0'] )] . " " . ($_POST ['sSortDir_0'] === 'asc' ? 'asc' : 'desc') . ", ";
	
	$sOrder = substr_replace ( $sOrder, "", - 2 );
	if ($sOrder == "ORDER BY") {
		$sOrder = "";
	}
}
// if(!$sOrder){
	
		// $sOrder = "ORDER BY STATUS_DATE DESC";
	
// }
$eWhere="";
if($bulan <> "" && $tahun <> ""){
		 $eWhere = "AND YYYYMM = '".$bulan."-".$tahun."'";
}elseif($tahun <> ""){
	$eWhere .= "AND SUBSTR(YYYYMM, 5, 4) = '".$tahun."'";
}elseif($bulan <> ""){
	$eWhere .= "AND SUBSTR(YYYYMM, 0, 3) = '".$bulan."'";
}
	
// die($eWhere);
	// $eWhere = "AND YYYYMM ='$bln-$thn'";
	// if($param['bulan']=="" && $param['tahun']==""){ 
		// $sql="SELECT * FROM WINS_DWH.MART_DAILY_CONSTELLATION_IC WHERE 1=1";
	// }else{
		// $sql="SELECT * FROM WINS_DWH.MART_DAILY_CONSTELLATION_IC WHERE 1=1 $eWhere";
	// }

		// $sWhere = " WHERE 1=1 AND TO_CHAR(STATUS_DATE, 'YYYY-MM-DD') BETWEEN '$tgl_from' AND '$tgl_to' ";
if ( isset($_POST['sSearch']) && $_POST['sSearch'] != "" ){
	if ( $sWhere == "" )
	{
		$sWhere .= "WHERE (";
	}
	else
	{
		$sWhere .= "and (";
	}
	for ( $i=1 ; $i<count($aColumns) ; $i++ )
	{
		$sWhere .= " lower(a.".$aColumns[$i].") LIKE '%".strtolower($POST['sSearch'])."%' OR ";
	}
	//die($sWhere);
	$sWhere = substr_replace( $sWhere, "", -3 );
	$sWhere .= ')';
}
		// die($sWhere);
		
		/* Individual column filtering */
		for($i = 1; $i < count ($aColumns ); $i ++ ) {
				if(isset($POST['bSearchable_' . $i])&& $POST['bSearchable_' . 
								 $i] == "true" && $POST['sSearch_' . 
								 $i] != '') {
						if($sWhere == "") {
								$sWhere = "WHERE ";
						} else {
								$sWhere .= " AND ";
						}
					 $sWhere .= " lower(a.".$aColumns[$i].") LIKE '%".strtolower($_POST['sSearch_'.$i])."%' ";
				}
		}


// Zend_Debug::dump($awal); die($to);

	$sql = "SELECT * from mock_data";

		
 // die($sql);
		try {
				$data = $this->_db->fetchAll($sql);
				// Zend_Debug::dump($data);die(); 
				return $data;
		}
		catch(Exception $e) {
				Zend_Debug::dump($e->getMessage());
				die($q);
		}
}

function count_list_tabletes() {
		$aColumns = array(
			'ID',
			'FIRST_NAME',
			'LAST_NAME',
			'EMAIL',
			'GENDER'
);
		
	 $sOrder = "";
if (isset ( $_POST ['iSortCol_0'] )) {
	$sOrder = "ORDER BY  ";
	for($i = 1; $i < intval ( $_POST ['iSortingCols'] ); $i ++) {
		if ($_POST ['bSortable_' . intval ( $_POST ['iSortCol_' . $i] )] == "true") {
			$sOrder .= "".$aColumns [intval ( $_POST ['iSortCol_' . $i] )] . "` " . ($_POST ['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
		}
	}
	
	$sOrder = substr_replace ( $sOrder, "", - 2 );
	if ($sOrder == "ORDER BY") {
		$sOrder = "";
	}
}
		
// $eWhere="";
// if($bulan <> "" && $tahun <> ""){
	 // $eWhere = "AND YYYYMM like '%".$bulan."-".$tahun."%'";
// }
	
$eWhere="";
if($bulan <> "" && $tahun <> ""){
		 $eWhere = "AND YYYYMM = '".$bulan."-".$tahun."'";
}elseif($tahun <> ""){
	$eWhere .= "AND SUBSTR(YYYYMM, 5, 4) = '".$tahun."'";
}elseif($bulan <> ""){
	$eWhere .= "AND SUBSTR(YYYYMM, 0, 3) = '".$bulan."'";
}
	
		// $sWhere = " WHERE 1=1 AND TO_CHAR(STATUS_DATE, 'YYYY-MM-DD') BETWEEN '$tgl_from' AND '$tgl_to' ";
		if(isset($POST['sSearch'])&& $POST['sSearch'] != "") {
	$sStr = strtoupper($POST['sSearch']);
				$sWhere .= " AND (";
				for($i = 1; $i < count ($aColumns ); $i ++ ) {
		$sWhere .= " " .$aColumns[$i]. " LIKE '%" . $sStr . "%' OR ";
				}
				// die($sWhere);
				$sWhere = substr_replace($sWhere, "", - 3);
				$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for($i = 1;
		$i < count ($aColumns );
		$i ++ ) {
				if(isset($POST['bSearchable_' . $i])&& $POST['bSearchable_' . 
								 $i] == "true" && $POST['sSearch_' . 
								 $i] != '') {
						if($sWhere == "") {
								$sWhere = "WHERE ";
						} else {
								$sWhere .= " AND ";
						}
						 // $sWhere .= " lower(a.".$aColumns[$i].") LIKE '%".strtolower($_POST['sSearch_'. $i])."%' ";
						 $sWhere .= " lower(".$aColumns[$i].") LIKE '%".strtolower($_POST['sSearch_'. $i])."%' ";
				}
		}

		$qry = "select COUNT(*) from tesx.mock_data WHERE 1=1 "  . $sWhere . " ". $sOrder;
// die($qry);
		try {
				$data = $this->_db->fetchOne($qry);
				// Zend_Debug::dump($data);die();
				return $data;
		}
		catch(Exception $e) {
				Zend_Debug::dump($e->getMessage());
				die($q);
		}
}

}

