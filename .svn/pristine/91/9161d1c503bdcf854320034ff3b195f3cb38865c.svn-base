<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class EmployeeMapping extends DbObject
{
	public static $tableName = "timesheets.dbo.employee_mappings";
	public $exists = false;

	/** [[Column=employee_mapping_id, DataType=int, Description=Employee Mapping, ReadOnly=true]]*/
	public $employee_mapping_id;

	/** [[Column=employee_id, DataType=int, Description=Employee, Required=true]]*/
	public $employee_id;

	/** [[Column=user_id, DataType=int, Description=User, Required=true]]*/
	public $user_id;

	// foreign key fields (will be populated upon request)
	
	public $employee;
	public function getEmployee()
	{
		$this->employee = new Employee($this->employee_id);
	}
	
	public $user;
	public function getUser()
	{
		$this->user = new Authentication_User($this->user_id);
	}
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE employee_mapping_id=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->employee_mapping_id > 0)
			$this->exists = true;
	}
	
	
	public function getEmployeeMappings($args=array())
	{
		global $db;
		
		$query = "SELECT au.*, strFullName, lngID, e.* 
			FROM ".self::$tableName." e 
				INNER JOIN ".Employee::$tableName." te ON e.employee_id=te.lngID
				INNER JOIN ".Authentication_User::$tableName." au ON e.user_id=au.user_id
			WHERE 1=1 
				".(@is_array($args['employee_mapping_ids']) ? " AND employee_mapping_id IN (". implode(",", $args['employee_mapping_ids']).") " : "")."
				".(@$args['employee_id'] != '' ? " AND employee_id={$args['employee_id']} " : "")."
				".(@$args['user_id'] != '' ? " AND au.user_id={$args['user_id']} " : "")."
			ORDER BY employee_id";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new EmployeeMapping();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			$obj->employee = new Employee();
			$obj->employee->setPropertyValues($r);
			$obj->employee->exists = true;
			
			$obj->user = new Authentication_User();
			$obj->user->setPropertyValues($r);
			$obj->user->exists = true;
			
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
		$query = ($this->exists ? $this->updateString(self::$tableName, 'employee_mapping_id') : $this->insertString(self::$tableName));

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
		$query="DELETE FROM ".self::$tableName." WHERE employee_mapping_id=".$this->employee_mapping_id;

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
