<?php
require_once("includes/controller_included.php");
//require_once("includes/Employee.php");

$status->destination = "add_tblEmployee";
$employee = new Employee(@$_GET['id']);
$employee->setPropertyValues($_POST);
if ($employee->exists) {
	$status->destination = "add_tblEmployee&id=".$employee->lngID;
}

if (!$employee->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$employee->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $employee->exists;
	
	$employee->startTrans();
	
	$result = $employee->save();
	
	/**/
	if (!$existed) {
		$employee->lngID = $employee->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$employee->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblEmployees";
		$status->status = "Success";
		$status->message = "TblEmployee ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblEmployee&id=".$employee->lngID."'>click here</a> to make additional changes";
		
		$employee->commitTrans();
		
		//LOG
		log_entry("Employee", ($existed ? "UPDATE" : "ADD"), $employee->lngID, $employee);
	}
}

return $status;
?>
