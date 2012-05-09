<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class Bulletin extends DbObject
{
	public static $tableName = "tblBulletins";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=blnActive, DataType=bit, Description=BlnActive, Required=true]]*/
	public $blnActive;

	/** [[Column=strTitle, DataType=varchar, Description=StrTitle, MaxLength=255]]*/
	public $strTitle;

	/** [[Column=strBulletin, DataType=varchar, Description=StrBulletin, MaxLength=1073741823]]*/
	public $strBulletin;

	/** [[Column=datDate, DataType=datetime, Description=DatDate]]*/
	public $datDate;

	/** [[Column=bytTarget, DataType=smallint, Description=BytTarget]]*/
	public $bytTarget;

	/** [[Column=lngDepartmentID, DataType=int, Description=LngDepartmentID]]*/
	public $lngDepartmentID;

	/** [[Column=lngShiftID, DataType=int, Description=LngShiftID]]*/
	public $lngShiftID;

	/** [[Column=blnRequireAcceptance, DataType=bit, Description=BlnRequireAcceptance, Required=true]]*/
	public $blnRequireAcceptance;

	/** [[Column=blnHighPriority, DataType=bit, Description=BlnHighPriority, Required=true]]*/
	public $blnHighPriority;

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
	
	
	public function getBulletins($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['blnActive'] != '' ? " AND blnActive={$args['blnActive']} " : "")."
				".(@$args['strTitle'] != '' ? " AND strTitle='{$args['strTitle']}' " : "")."
				".(@is_array($args['strBulletins']) ? " AND strBulletin IN (". implode(",", $args['strBulletins']).") " : "")."
				".(@$args['datDate'] != '' ? " AND datDate BETWEEN '{$args['datDate']}' AND '{$args['datDate']} 23:59:59'" : "")."
				".(@$args['bytTarget'] != '' ? " AND bytTarget={$args['bytTarget']} " : "")."
				".(@$args['lngDepartmentID'] != '' ? " AND lngDepartmentID={$args['lngDepartmentID']} " : "")."
				".(@$args['lngShiftID'] != '' ? " AND lngShiftID={$args['lngShiftID']} " : "")."
				".(@$args['blnRequireAcceptance'] != '' ? " AND blnRequireAcceptance={$args['blnRequireAcceptance']} " : "")."
				".(@$args['blnHighPriority'] != '' ? " AND blnHighPriority={$args['blnHighPriority']} " : "")."
			ORDER BY blnActive";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new Bulletin();
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
