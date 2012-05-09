<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class TimeLogging extends DbObject
{
	public static $tableName = "tblTimeLogging";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=strDate, DataType=varchar, Description=StrDate, MaxLength=255]]*/
	public $strDate;

	/** [[Column=strLogType, DataType=varchar, Description=StrLogType, MaxLength=255]]*/
	public $strLogType;

	/** [[Column=strTimeID, DataType=varchar, Description=StrTimeID, MaxLength=255]]*/
	public $strTimeID;

	/** [[Column=strEvent, DataType=varchar, Description=StrEvent, MaxLength=255]]*/
	public $strEvent;

	/** [[Column=strEventType, DataType=varchar, Description=StrEventType, MaxLength=255]]*/
	public $strEventType;

	/** [[Column=strClassificationID, DataType=varchar, Description=StrClassificationID, MaxLength=255]]*/
	public $strClassificationID;

	/** [[Column=strDelegateID, DataType=varchar, Description=StrDelegateID, MaxLength=255]]*/
	public $strDelegateID;

	/** [[Column=strDepartmentID, DataType=varchar, Description=StrDepartmentID, MaxLength=255]]*/
	public $strDepartmentID;

	/** [[Column=strOvertimeCalculationMethod, DataType=varchar, Description=StrOvertimeCalculationMethod, MaxLength=255]]*/
	public $strOvertimeCalculationMethod;

	/** [[Column=strComputerID, DataType=varchar, Description=StrComputerID, MaxLength=255]]*/
	public $strComputerID;

	/** [[Column=strJobID, DataType=varchar, Description=StrJobID, MaxLength=255]]*/
	public $strJobID;

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
	
	
	public function getTimeLogging($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['strDate'] != '' ? " AND strDate='{$args['strDate']}' " : "")."
				".(@$args['strLogType'] != '' ? " AND strLogType='{$args['strLogType']}' " : "")."
				".(@$args['strTimeID'] != '' ? " AND strTimeID='{$args['strTimeID']}' " : "")."
				".(@$args['strEvent'] != '' ? " AND strEvent='{$args['strEvent']}' " : "")."
				".(@$args['strEventType'] != '' ? " AND strEventType='{$args['strEventType']}' " : "")."
				".(@$args['strClassificationID'] != '' ? " AND strClassificationID='{$args['strClassificationID']}' " : "")."
				".(@$args['strDelegateID'] != '' ? " AND strDelegateID='{$args['strDelegateID']}' " : "")."
				".(@$args['strDepartmentID'] != '' ? " AND strDepartmentID='{$args['strDepartmentID']}' " : "")."
				".(@$args['strOvertimeCalculationMethod'] != '' ? " AND strOvertimeCalculationMethod='{$args['strOvertimeCalculationMethod']}' " : "")."
				".(@$args['strComputerID'] != '' ? " AND strComputerID='{$args['strComputerID']}' " : "")."
				".(@$args['strJobID'] != '' ? " AND strJobID='{$args['strJobID']}' " : "")."
			ORDER BY strDate";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new TimeLogging();
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
