<?php

require_once("includes/controller_included.php");

$args = $_REQUEST;
$timesheet_info_data = json_decode($args['timesheet_info'], true);
$timesheet_info = new TimesheetInfo($timesheet_info_data);
$timesheet_settings = new TimesheetSettings(array(
    'success_message' => 'Emptied',
    'from_db' => true,
    'validate' => false
));
$timesheet = new TimesheetOneDay($timesheet_info, $timesheet_settings);

$day_data = json_decode($args['json'], true);
$timesheet->set_day_state($day_data);

$transaction = new TimesheetDay();
$transaction->startTrans();

$delete_array_TimeModified_db = $timesheet->get_delete_array_TimeModified_db();
foreach ($delete_array_TimeModified_db as $TimeModified_obj) {
	$result = $TimeModified_obj->delete();
	if (PEAR::isError($result)) {
		$transaction->rollbackTrans();
		$day_data['error'] = "Could not delete a time modified record";
		$day_data['success'] = '';
		$status->message = $day_data;
		return $status;
	}
	log_entry("TimeModified", "DELETE", $TimeModified_obj->time_modified_id, $TimeModified_obj);
}

$update_TimesheetDay_db = $timesheet->get_update_TimesheetDay_db($type = 'mark_empty');
$existed = $update_TimesheetDay_db->exists;
if (!empty($update_TimesheetDay_db)) {
	$result = $update_TimesheetDay_db->save();
	if (PEAR::isError($result)) {
		$transaction->rollbackTrans();
		$day_data['error'] = "Could not update a timesheet day record";
		$day_data['success'] = '';
		$status->message = $day_data;
		return $status;
	}
	log_entry("TimesheetDay", ($existed ? "UPDATE" : "ADD"), $update_TimesheetDay_db->timesheet_day_id, $update_TimesheetDay_db);
}

$transaction->commitTrans();

$day_data = $timesheet->get_reprocessed_day($day_data);

$status->message = $day_data;

$status->status = "Success";
return $status;
?>
