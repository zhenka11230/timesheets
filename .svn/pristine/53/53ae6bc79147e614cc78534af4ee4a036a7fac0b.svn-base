<?php
require_once("includes/controller_included.php");
//require_once("includes/Holiday.php");

$status->destination = "add_tblHoliday";
$holiday = new Holiday(@$_GET['id']);
$holiday->setPropertyValues($_POST);
if ($holiday->exists) {
	$status->destination = "add_tblHoliday&id=".$holiday->lngID;
}

if (!$holiday->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$holiday->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $holiday->exists;
	
	$holiday->startTrans();
	
	$result = $holiday->save();
	
	/**/
	if (!$existed) {
		$holiday->lngID = $holiday->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$holiday->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblHolidays";
		$status->status = "Success";
		$status->message = "TblHoliday ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblHoliday&id=".$holiday->lngID."'>click here</a> to make additional changes";
		
		$holiday->commitTrans();
		
		//LOG
		log_entry("Holiday", ($existed ? "UPDATE" : "ADD"), $holiday->lngID, $holiday);
	}
}

return $status;
?>
