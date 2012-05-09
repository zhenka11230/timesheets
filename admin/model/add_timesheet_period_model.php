<?php
require_once("includes/controller_included.php");
//require_once("includes/TimesheetPeriod.php");

$status->destination = "add_timesheet_period";
$timesheetPeriod = new TimesheetPeriod(@$_GET['id']);
$timesheetPeriod->setPropertyValues($_POST);
if ($timesheetPeriod->exists) {
	$status->destination = "add_timesheet_period&id=".$timesheetPeriod->timesheet_period_id;
}

$timesheetPeriod->end_date = date("Y-m-d", strtotime($timesheetPeriod->end_date))." 23:59:00";

if (!$timesheetPeriod->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$timesheetPeriod->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $timesheetPeriod->exists;
	
	$timesheetPeriod->startTrans();
	
	$result = $timesheetPeriod->save();
	
	/**/
	if (!$existed) {
		$timesheetPeriod->timesheet_period_id = $timesheetPeriod->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$timesheetPeriod->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "timesheet_periods";
		$status->status = "Success";
		$status->message = "Timesheet Period ".($existed ? "updated" : "added")." successfully, <a href='?view=add_timesheet_period&id=".$timesheetPeriod->timesheet_period_id."'>click here</a> to make additional changes";
		
		$timesheetPeriod->commitTrans();
		
		//LOG
		log_entry("TimesheetPeriod", ($existed ? "UPDATE" : "ADD"), $timesheetPeriod->timesheet_period_id, $timesheetPeriod);
	}
}

return $status;
?>
