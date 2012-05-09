<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class Tip extends DbObject
{
	public static $tableName = "tblTips";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=lngEmployeeID, DataType=int, Description=LngEmployeeID]]*/
	public $lngEmployeeID;

	/** [[Column=datReceived, DataType=datetime, Description=DatReceived]]*/
	public $datReceived;

	/** [[Column=datRecorded, DataType=datetime, Description=DatRecorded]]*/
	public $datRecorded;

	/** [[Column=sngDirect, DataType=real, Description=SngDirect]]*/
	public $sngDirect;

	/** [[Column=sngDebitCredit, DataType=real, Description=SngDebitCredit]]*/
	public $sngDebitCredit;

	/** [[Column=sngPaidOut, DataType=real, Description=SngPaidOut]]*/
	public $sngPaidOut;

	/** [[Column=blnEdited, DataType=bit, Description=BlnEdited, Required=true]]*/
	public $blnEdited;

	// foreign key fields (will be populated upon request)
	
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE lngID=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->lngID > 0)
			$this->exists = true;
	}
	
	
	public function getTips($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['lngEmployeeID'] != '' ? " AND lngEmployeeID={$args['lngEmployeeID']} " : "")."
				".(@$args['datReceived'] != '' ? " AND datReceived BETWEEN '{$args['datReceived']}' AND '{$args['datReceived']} 23:59:59'" : "")."
				".(@$args['datRecorded'] != '' ? " AND datRecorded BETWEEN '{$args['datRecorded']}' AND '{$args['datRecorded']} 23:59:59'" : "")."
				".(@$args['sngDirect'] != '' ? " AND sngDirect={$args['sngDirect']} " : "")."
				".(@$args['sngDebitCredit'] != '' ? " AND sngDebitCredit={$args['sngDebitCredit']} " : "")."
				".(@$args['sngPaidOut'] != '' ? " AND sngPaidOut={$args['sngPaidOut']} " : "")."
				".(@$args['blnEdited'] != '' ? " AND blnEdited={$args['blnEdited']} " : "")."
			ORDER BY lngEmployeeID";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new Tip();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			array_push($items, $obj);
		}
		
		return $items;
	}
	
	public function getCount()
	{
		global $db;
		
		$query = "SELECT count(*) FROM ".self::$tableName;
		return $db->getOne($query);
	}
	
	public function save($delete=0)
	{	
		/*
		global $login_info;

		$user = $login_info->get_user_info();
		
		$this->modified_by = (isset($user['first_name']) ? $user['first_name'].' '.$user['last_name'] : $user['username']);
		*/
		//$this->last_modified = date("Y-m-d G:i:s");
		//$this->deleted = ($delete == 1 || $delete === true ? '1' : '0');
		
		// create query
		$query = ($this->exists ? $this->updateString(self::$tableName, 'lngID') : $this->insertString(self::$tableName));

		// prepare query
		$stmt = $this->db->prepare($query);

		// execute statement
		$result =& $this->db->execute($stmt);
		
		/*if (PEAR::isError($result)) {
			throw new Exception($result->getMessage());
		}*/
		
		return $result;
	}
	
	public function delete($method='hard')
	{
		if ($method == 'soft')
			return $this->save(1);
			
		// create query
		$query="DELETE FROM ".self::$tableName." WHERE lngID=".$this->lngID;

		// prepare query
		$stmt = $this->db->prepare($query);

		// execute statement
		$result =& $this->db->execute($stmt);
		
		/*if (PEAR::isError($result)) {
			throw new Exception($result->getMessage());
		}*/
		
		return $result;
	}
}
