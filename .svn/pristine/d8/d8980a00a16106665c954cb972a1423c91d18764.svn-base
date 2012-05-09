<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class Job extends DbObject
{
	public static $tableName = "tblJobs";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=lngCode, DataType=int, Description=LngCode]]*/
	public $lngCode;

	/** [[Column=strName, DataType=varchar, Description=StrName, MaxLength=255]]*/
	public $strName;

	/** [[Column=strDescription, DataType=varchar, Description=StrDescription, MaxLength=1073741823]]*/
	public $strDescription;

	/** [[Column=blnDisabled, DataType=bit, Description=BlnDisabled, Required=true]]*/
	public $blnDisabled;

	/** [[Column=blnDeleted, DataType=bit, Description=BlnDeleted, Required=true]]*/
	public $blnDeleted;

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
	
	
	public function getJobs($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['lngCode'] != '' ? " AND lngCode={$args['lngCode']} " : "")."
				".(@$args['strName'] != '' ? " AND strName='{$args['strName']}' " : "")."
				".(@$args['strDescription'] != '' ? " AND strDescription='{$args['strDescription']}' " : "")."
				".(@$args['blnDisabled'] != '' ? " AND blnDisabled={$args['blnDisabled']} " : "")."
				".(@$args['blnDeleted'] != '' ? " AND blnDeleted={$args['blnDeleted']} " : "")."
			ORDER BY lngCode";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new Job();
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
