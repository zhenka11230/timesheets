<?php

require_once("includes/controller_included.php");

$args = $_REQUEST;
$timesheet_info_data = json_decode($args['timesheet_info'], true);
$timesheet_info = new TimesheetInfo($timesheet_info_data);
$up_hours_cut = $args['up_hours_cut'];
$down_hours_cut = $args['down_hours_cut'];
$timesheet_settings = new TimesheetSettings(array(
    'overtime' => false,
    'up_hours_cut' => $up_hours_cut,
    'down_hours_cut' => $down_hours_cut
));

$timesheet = new TimesheetTwoWeeks($timesheet_info, $timesheet_settings);
$transaction = new TimesheetDay();



if (!preg_match("/^((?:1[0-2])|(?:0?[0-9])):([0-5][0-9])(\s)(am|pm)$/", $up_hours_cut) || !preg_match("/^((?:1[0-2])|(?:0?[0-9])):([0-5][0-9])(\s)(am|pm)$/", $up_hours_cut)) {
	$status->error = 'Invalid input';
	return $status;
}

try {
	$timesheet->init_selectively_from_db();
} catch (Exception $e) {
	$status->error = $e->getMessage();
	return $status;
}

$two_weeks_save_array_TimeModified_db = $timesheet->get_two_weeks_save_array_TimeModified_db($only_overtime = true);

if (empty($two_weeks_save_array_TimeModified_db)) {
	$status->error = "Nothing to trim.  Days that were modified are not trimmed.";
	return $status;
}
$transaction->startTrans();
foreach ($two_weeks_save_array_TimeModified_db as $TimeModified_obj) {
	$result = $TimeModified_obj->save();
	if (PEAR::isError($result)) {
		$transaction->rollbackTrans();
		$status->error = "Could not update a timesheet day record";
		return $status;
	}
	log_entry("TimeModified", "ADD", $TimeModified_obj->time_modified_id, $TimeModified_obj);
}
$transaction->commitTrans();
$status->message = $timesheet->get_timesheet_data();


//patch to make sure it sais modified YES when a day is trimmed
foreach($status->message as &$day){
	if(preg_match('/Hours were cut off:/i', $day['warning'])){
		$day['is_modified'] = 'Yes';
	}
	unset($day);
}

$status->status = "Success";

return $status;
?>
