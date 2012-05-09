<?php

require_once("includes/controller_included.php");

$args = $_REQUEST;
$timesheet_info_data = json_decode($args['timesheet_info'], true);
$timesheet_info = new TimesheetInfo($timesheet_info_data);
$timesheet_settings = new TimesheetSettings(array(
    'success_message' => 'Saved',
    'validate' => 'only_TimesheetDay',
    'persist_source_db' => true
));

$timesheet = new TimesheetOneDay($timesheet_info, $timesheet_settings);

$transaction = new TimesheetDay();
$transaction->startTrans();
$input_error = '';

$day_data = json_decode($args['json'], true);

$day_data = $timesheet->get_reprocessed_day($day_data);
$update_TimesheetDay_db = $timesheet->get_update_TimesheetDay_db($type = 'user_save');
if (empty($day_data['input_error'])) {
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
} else {
	$day_data['success'] = '';
}

$transaction->commitTrans();
$status->message = $day_data;

$status->status = "Success";
return $status;
?>
