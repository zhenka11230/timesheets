<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class TimesheetDay extends DbObject
{
	public static $tableName = "timesheets.dbo.timesheet_days";
	public $exists = false;

	/** [[Column=timesheet_day_id, DataType=int, Description=Timesheet Day, ReadOnly=true]]*/
	public $timesheet_day_id;

	/** [[Column=employee_id, DataType=int, Description=Employee, Required=true]]*/
	public $employee_id;

	/** [[Column=date, DataType=datetime, Description=Date, Required=true]]*/
	public $date;

	/** [[Column=sick_hours, DataType=float, Description=Sick Hours]]*/
	public $sick_hours;

	/** [[Column=annual_hours, DataType=float, Description=Annual Hours]]*/
	public $annual_hours;

	/** [[Column=comments, DataType=varchar, Description=Comments]]*/
	public $comments;
	
	/** [[Column=mark_empty, DataType=bit, Description=Mark Empty]]*/
	public $mark_empty;

	// foreign key fields (will be populated upon request)
	
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE timesheet_day_id=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->timesheet_day_id > 0)
			$this->exists = true;
	}
//	
	
	public function getTimesheetDays($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@is_array($args['timesheet_day_ids']) ? " AND timesheet_day_id IN (". implode(",", $args['timesheet_day_ids']).") " : "")."
				".(@$args['employee_id'] != '' ? " AND employee_id={$args['employee_id']} " : "")."
				".(@$args['date'] != '' ? " AND date BETWEEN '{$args['date']}' AND '{$args['date']} 23:59:59'" : "")."
				".(@$args['sick_hours'] != '' ? " AND sick_hours={$args['sick_hours']} " : "")."
				".(@$args['annual_hours'] != '' ? " AND annual_hours={$args['annual_hours']} " : "")."
				".(@$args['comments'] != '' ? " AND comments='{$args['comments']}' " : "")."
				".(@$args['time_range_id'] != '' ? " AND date BETWEEN (SELECT start_date FROM timesheets.dbo.timesheet_periods WHERE timesheet_period_id='{$args['time_range_id']}') AND (SELECT end_date FROM timesheets.dbo.timesheet_periods WHERE timesheet_period_id='{$args['time_range_id']}')" : "")."
				".(@$args['mark_empty'] != '' ? " AND comments='{$args['mark_empty']}' " : "")."
			ORDER BY employee_id";
								
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new TimesheetDay();
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
		$query = ($this->exists ? $this->updateString(self::$tableName, 'timesheet_day_id') : $this->insertString(self::$tableName));

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
		$query="DELETE FROM ".self::$tableName." WHERE timesheet_day_id=".$this->timesheet_day_id;

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
