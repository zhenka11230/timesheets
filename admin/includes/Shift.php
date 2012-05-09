<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class Shift extends DbObject
{
	public static $tableName = "tblShifts";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=strName, DataType=varchar, Description=StrName, MaxLength=255]]*/
	public $strName;

	/** [[Column=dblLoading, DataType=float, Description=DblLoading]]*/
	public $dblLoading;

	/** [[Column=bytHourStart, DataType=smallint, Description=BytHourStart]]*/
	public $bytHourStart;

	/** [[Column=bytMinuteStart, DataType=smallint, Description=BytMinuteStart]]*/
	public $bytMinuteStart;

	/** [[Column=bytHourEnd, DataType=smallint, Description=BytHourEnd]]*/
	public $bytHourEnd;

	/** [[Column=bytMinuteEnd, DataType=smallint, Description=BytMinuteEnd]]*/
	public $bytMinuteEnd;

	/** [[Column=bytRestrictClockInLimit, DataType=smallint, Description=BytRestrictClockInLimit]]*/
	public $bytRestrictClockInLimit;

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
	
	
	public function getShifts($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['strName'] != '' ? " AND strName='{$args['strName']}' " : "")."
				".(@$args['dblLoading'] != '' ? " AND dblLoading={$args['dblLoading']} " : "")."
				".(@$args['bytHourStart'] != '' ? " AND bytHourStart={$args['bytHourStart']} " : "")."
				".(@$args['bytMinuteStart'] != '' ? " AND bytMinuteStart={$args['bytMinuteStart']} " : "")."
				".(@$args['bytHourEnd'] != '' ? " AND bytHourEnd={$args['bytHourEnd']} " : "")."
				".(@$args['bytMinuteEnd'] != '' ? " AND bytMinuteEnd={$args['bytMinuteEnd']} " : "")."
				".(@$args['bytRestrictClockInLimit'] != '' ? " AND bytRestrictClockInLimit={$args['bytRestrictClockInLimit']} " : "")."
			ORDER BY strName";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new Shift();
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
