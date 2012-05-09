<?php
require_once("includes/controller_included.php");
//require_once("includes/EmploymentType.php");

$status->destination = "add_tblEmploymentType";
$employmentType = new EmploymentType(@$_GET['id']);
$employmentType->setPropertyValues($_POST);
if ($employmentType->exists) {
	$status->destination = "add_tblEmploymentType&id=".$employmentType->lngID;
}

if (!$employmentType->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$employmentType->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $employmentType->exists;
	
	$employmentType->startTrans();
	
	$result = $employmentType->save();
	
	/**/
	if (!$existed) {
		$employmentType->lngID = $employmentType->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$employmentType->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblEmploymentTypes";
		$status->status = "Success";
		$status->message = "TblEmploymentType ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblEmploymentType&id=".$employmentType->lngID."'>click here</a> to make additional changes";
		
		$employmentType->commitTrans();
		
		//LOG
		log_entry("EmploymentType", ($existed ? "UPDATE" : "ADD"), $employmentType->lngID, $employmentType);
	}
}

return $status;
?>
