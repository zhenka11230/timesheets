<?php
require_once("includes/controller_included.php");
//require_once("includes/Department.php");

$status->destination = "add_tblDepartment";
$department = new Department(@$_GET['id']);
$department->setPropertyValues($_POST);
if ($department->exists) {
	$status->destination = "add_tblDepartment&id=".$department->lngID;
}

if (!$department->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$department->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $department->exists;
	
	$department->startTrans();
	
	$result = $department->save();
	
	/**/
	if (!$existed) {
		$department->lngID = $department->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$department->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblDepartments";
		$status->status = "Success";
		$status->message = "TblDepartment ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblDepartment&id=".$department->lngID."'>click here</a> to make additional changes";
		
		$department->commitTrans();
		
		//LOG
		log_entry("Department", ($existed ? "UPDATE" : "ADD"), $department->lngID, $department);
	}
}

return $status;
?>
