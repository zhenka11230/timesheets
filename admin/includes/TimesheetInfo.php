<?php

class TimesheetInfo {
	
	function __construct($timesheet_info = array()){
		$this->employee = new Employee($timesheet_info['employee_id']);
		$this->employee->department = new Department($timesheet_info['department_id']);
        $this->employee->employment_type = new EmploymentType($this->employee->lngEmploymentType);
		$this->timesheet_period = new TimesheetPeriod($timesheet_info['timesheet_period_id']);
	}

    function get_employee_id(){
        return $this->employee->lngID;
    }

    function get_timesheet_period_id(){
        return $this->timesheet_period->timesheet_period_id;
    }

    function get_department_id(){
        return $this->employee->lngDepartmentID;
    }

    function get_employment_type(){
        return strtolower($this->employee->employment_type->strName);
    }

    function is_eligable_for_overtime(){
        return $this->employee->employment_type->is_eligable_for_overtime();
    }
	
	
	public $employee;
	public $timesheet_period;
}

?>
