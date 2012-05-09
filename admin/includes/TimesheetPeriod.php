<?php
//require_once(dirname(__FILE__)."/DbObject.php");
//require_once(dirname(__FILE__)."/TimesheetPeriod.php");

class TimesheetPeriod extends DbObject
{
	public static $tableName = "timesheets.dbo.timesheet_periods";
	public $exists = false;

	/** [[Column=timesheet_period_id, DataType=int, Description=Timesheet Period, ReadOnly=true]]*/
	public $timesheet_period_id;

	/** [[Column=start_date, DataType=datetime, Description=Start Date, Required=true]]*/
	public $start_date;

	/** [[Column=end_date, DataType=datetime, Description=End Date, Required=true]]*/
	public $end_date;

	// foreign key fields (will be populated upon request)
	
	public $timesheetPeriod;
	public function getTimesheetPeriod()
	{
		$this->timesheetPeriod = new self($this->timesheet_period_id);
	}
	
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE timesheet_period_id=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->timesheet_period_id > 0)
			$this->exists = true;
	}
	
	
	public function getTimesheetPeriods($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
				".(@$args['with_timesheet_periods'] == true ? " INNER JOIN timesheet_periods t ON t.timesheet_period_id = t.timesheet_period_id " : "")."
			WHERE 1=1 
				".(@$args['timesheet_period_id'] != '' ? " AND timesheet_period_id={$args['timesheet_period_id']} " : "")."
				".(@!empty($args['timesheet_period_ids']) ? " AND timesheet_period_id IN (".implode(",",$args['timesheet_period_ids']).") " : "")."
				".(@$args['start_date'] != '' ? " AND start_date BETWEEN '{$args['start_date']}' AND '{$args['start_date']} 23:59:59'" : "")."
				".(@$args['end_date'] != '' ? " AND end_date BETWEEN '{$args['end_date']}' AND '{$args['end_date']} 23:59:59'" : "")."
				".(@$args['date'] != '' ? " AND '{$args['date']}' BETWEEN start_date AND end_date" : "")."
			ORDER BY start_date";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new TimesheetPeriod();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			if (@$args['with_timesheetperiods'] == true) {
				$obj->timesheetPeriod = new self();
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
		$query = ($this->exists ? $this->updateString(self::$tableName, 'timesheet_period_id') : $this->insertString(self::$tableName));

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
		$query="DELETE FROM ".self::$tableName." WHERE timesheet_period_id=".$this->timesheet_period_id;

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
