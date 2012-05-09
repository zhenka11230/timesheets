<?php
require_once("includes/controller_included.php");
//require_once("includes/EmployeeMapping.php");

$status->destination = "employee_mappings";

$ids = array();

if (isset($_GET['id'])) {
	if (!is_array($_GET['id']) && is_numeric($_GET['id']))
		$ids[] = (int)$_GET['id'];
	else if (is_array($_GET['id']))
		$ids = $_GET['id'];
}
else {
	return handle_error($status, 'ID(s) missing');
}

$employeeMappings = EmployeeMapping::getEmployeeMappings(array('employee_mapping_ids'=>$ids));

foreach ($employeeMappings as $employeeMapping)
{
	if (!$employeeMapping->exists)
		continue;

	if (!$employeeMapping->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$employeeMapping->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$employeeMapping->startTrans();
		
		$result = $employeeMapping->delete();
		
		if (PEAR::isError($result)) {
			$employeeMapping->rollbackTrans();
			return handle_error($status, $result);
		}

		$employeeMapping->commitTrans();

		// LOG
		log_entry("EmployeeMapping", "DELETE", $employeeMapping->employee_mapping_id, $employeeMapping);
	}
}

$status->status = "Success";
$status->message = "Employee Mapping deleted successfully";

return $status;
?>
