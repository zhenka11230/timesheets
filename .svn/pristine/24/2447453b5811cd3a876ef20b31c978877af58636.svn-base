<?php
//require_once(dirname(__FILE__)."/DbObject.php");
//require_once(dirname(__FILE__)."/TimesheetPeriod.php");

class TimeModified extends DbObject
{
	public static $tableName = "timesheets.dbo.time_modified";
	public $exists = false;

	/** [[Column=time_modified_id, DataType=int, Description=Time Modified, ReadOnly=true]]*/
	public $time_modified_id;

	/** [[Column=timesheet_period_id, DataType=int, Description=Timesheet Period, Required=true]]*/
	public $timesheet_period_id;

	/** [[Column=lngID, DataType=int, Description=LngID, Required=true]]*/
	public $lngID;

	/** [[Column=lngEmployeeID, DataType=int, Description=LngEmployeeID]]*/
	public $lngEmployeeID;

	/** [[Column=datEvent, DataType=datetime, Description=DatEvent]]*/
	public $datEvent;

	/** [[Column=blnEventType, DataType=bit, Description=BlnEventType, Required=true]]*/
	public $blnEventType;

	/** [[Column=blnEdited, DataType=bit, Description=BlnEdited, Required=true]]*/
	public $blnEdited;

	/** [[Column=lngClassificationID, DataType=int, Description=LngClassificationID]]*/
	public $lngClassificationID;

	/** [[Column=lngDelegateID, DataType=int, Description=LngDelegateID]]*/
	public $lngDelegateID;

	/** [[Column=strHash, DataType=varchar, Description=StrHash, MaxLength=10]]*/
	public $strHash;

	/** [[Column=lngDepartmentID, DataType=int, Description=LngDepartmentID]]*/
	public $lngDepartmentID;

	/** [[Column=bytOvertimeCalculationMethod, DataType=smallint, Description=BytOvertimeCalculationMethod]]*/
	public $bytOvertimeCalculationMethod;

	/** [[Column=lngComputerID, DataType=int, Description=LngComputerID]]*/
	public $lngComputerID;

	/** [[Column=lngJobID, DataType=int, Description=LngJobID]]*/
	public $lngJobID;

	// foreign key fields (will be populated upon request)
	
	public $timesheetPeriod;
	public function getTimesheetPeriod()
	{
		$this->timesheetPeriod = new TimesheetPeriod($this->timesheet_period_id);
	}
	
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE time_modified_id=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->time_modified_id > 0)
			$this->exists = true;
	}
	
	
	public function getTimeModified($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
				".(@$args['with_timesheetperiods'] == true ? " INNER JOIN timesheetperiods t ON t.timesheet_period_id = t.timesheet_period_id " : "")."
			WHERE 1=1 
				".(@is_array($args['time_modified_ids']) ? " AND time_modified_id IN (". implode(",", $args['time_modified_ids']).") " : "")."
				".(@$args['timesheet_period_id'] != '' ? " AND timesheet_period_id={$args['timesheet_period_id']} " : "")."
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['lngEmployeeID'] != '' ? " AND lngEmployeeID={$args['lngEmployeeID']} " : "")."
				".(@$args['datEvent'] != '' ? " AND datEvent BETWEEN '{$args['datEvent']}' AND '{$args['datEvent']} 23:59:59'" : "")."
				".(@$args['blnEventType'] != '' ? " AND blnEventType={$args['blnEventType']} " : "")."
				".(@$args['blnEdited'] != '' ? " AND blnEdited={$args['blnEdited']} " : "")."
				".(@$args['lngClassificationID'] != '' ? " AND lngClassificationID={$args['lngClassificationID']} " : "")."
				".(@$args['lngDelegateID'] != '' ? " AND lngDelegateID={$args['lngDelegateID']} " : "")."
				".(@$args['strHash'] != '' ? " AND strHash='{$args['strHash']}' " : "")."
				".(@$args['lngDepartmentID'] != '' ? " AND lngDepartmentID={$args['lngDepartmentID']} " : "")."
				".(@$args['bytOvertimeCalculationMethod'] != '' ? " AND bytOvertimeCalculationMethod={$args['bytOvertimeCalculationMethod']} " : "")."
				".(@$args['lngComputerID'] != '' ? " AND lngComputerID={$args['lngComputerID']} " : "")."
				".(@$args['lngJobID'] != '' ? " AND lngJobID={$args['lngJobID']} " : "")."
			ORDER BY lngID";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new TimeModified();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			if (@$args['with_timesheetperiods'] == true) {
				$obj->timesheetPeriod = new TimesheetPeriod();
				$obj->timesheetPeriod->setPropertyValues($r);
				$obj->timesheetPeriod->exists = true;
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
		$query = ($this->exists ? $this->updateString(self::$tableName, 'time_modified_id') : $this->insertString(self::$tableName));

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
		$query="DELETE FROM ".self::$tableName." WHERE time_modified_id=".$this->time_modified_id;

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
