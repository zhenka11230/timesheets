<?php
require_once("includes/controller_included.php");
//require_once("includes/TimesheetPeriod.php");

$status->destination = "timesheet_periods";

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
$timesheetPeriods = TimesheetPeriod::getTimesheetPeriods(array('timesheet_period_ids'=>$ids));

foreach ($timesheetPeriods as $timesheetPeriod)
{
	if (!$timesheetPeriod->exists)
		continue;

	if (!$timesheetPeriod->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$timesheetPeriod->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$timesheetPeriod->startTrans();
		
		$result = $timesheetPeriod->delete();
		
		if (PEAR::isError($result)) {
			$timesheetPeriod->rollbackTrans();
			return handle_error($status, $result);
		}

		$timesheetPeriod->commitTrans();

		// LOG
		log_entry("TimesheetPeriod", "DELETE", $timesheetPeriod->timesheet_period_id, $timesheetPeriod);
	}
}

$status->status = "Success";
$status->message = "Timesheet Period deleted successfully";

return $status;
?>
