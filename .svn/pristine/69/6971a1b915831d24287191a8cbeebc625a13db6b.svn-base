<?php
//require_once(dirname(__FILE__)."/DbObject.php");
//require_once(dirname(__FILE__)."/Time.php");

class TimeNote extends DbObject
{
	public static $tableName = "tblTimeNotes";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=lngTimeID, DataType=int, Description=LngTimeID]]*/
	public $lngTimeID;

	/** [[Column=strNote, DataType=varchar, Description=StrNote, MaxLength=255]]*/
	public $strNote;

	/** [[Column=datDate, DataType=datetime, Description=DatDate]]*/
	public $datDate;

	// foreign key fields (will be populated upon request)
	
	public $time;
	public function getTime()
	{
		$this->time = new Time($this->lngTimeID);
	}
	
	
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
	
	
	public function getTimeNotes($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
				".(@$args['with_times'] == true ? " INNER JOIN times l ON t.lngTimeID = l.lngTimeID " : "")."
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['lngTimeID'] != '' ? " AND lngTimeID={$args['lngTimeID']} " : "")."
				".(@$args['strNote'] != '' ? " AND strNote='{$args['strNote']}' " : "")."
				".(@$args['datDate'] != '' ? " AND datDate BETWEEN '{$args['datDate']}' AND '{$args['datDate']} 23:59:59'" : "")."
			ORDER BY strNote";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new TimeNote();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			if (@$args['with_times'] == true) {
				$obj->time = new Time();
				$obj->time->setPropertyValues($r);
				$obj->time->exists = true;
			}

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
