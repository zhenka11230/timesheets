<?php
require_once("includes/controller_included.php");
//require_once("includes/EmployeeMapping.php");

$status->destination = "add_employee_mapping";
$employeeMapping = new EmployeeMapping(@$_GET['id']);
$employeeMapping->setPropertyValues($_POST);
if ($employeeMapping->exists) {
	$status->destination = "add_employee_mapping&id=".$employeeMapping->employee_mapping_id;
}

if (!$employeeMapping->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$employeeMapping->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $employeeMapping->exists;
	
	$employeeMapping->startTrans();
	
	$result = $employeeMapping->save();
	
	/**/
	if (!$existed) {
		$employeeMapping->employee_mapping_id = $employeeMapping->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$employeeMapping->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "employee_mappings";
		$status->status = "Success";
		$status->message = "Employee Mapping ".($existed ? "updated" : "added")." successfully, <a href='?view=add_employee_mapping&id=".$employeeMapping->employee_mapping_id."'>click here</a> to make additional changes";
		
		$employeeMapping->commitTrans();
		
		//LOG
		log_entry("EmployeeMapping", ($existed ? "UPDATE" : "ADD"), $employeeMapping->employee_mapping_id, $employeeMapping);
	}
}

return $status;
?>
