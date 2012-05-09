<?php

require_once("includes/controller_included.php");

$args = $_REQUEST;
$timesheet = new TimesheetTwoWeeks();
$transaction = new TimesheetDay();
$type = $args['type'];

if ($type == "get_timesheet") {
	$timesheet->timesheet_period_id = $args['timesheet_period_id'];
	$timesheet->employee_id = $args['employee_id'];
	$timesheet->init_selectively_from_db($overtime = true);
	$status->message = $timesheet->get_timesheet_data();
} elseif ($type == "save") {
	$transaction->startTrans();
	$input_error = '';

	$day_data = json_decode($args['json'], true);
	if (accessible_permission("is_admin", "model")) {
		$day_data = $timesheet->get_reprocessed_day($day_data, $validate = true, $success_message = "Saved");

		if (empty($day_data['input_error'])) {

			$delete_array_TimeModified_db = $timesheet->get_delete_array_TimeModified_db();
			//TODO: check against time_period violation
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

			$save_array_TimeModified_db = $timesheet->get_save_array_TimeModified_db();
			foreach ($save_array_TimeModified_db as $TimeModified_obj) {
				$result = $TimeModified_obj->save();
				if (PEAR::isError($result)) {
					$transaction->rollbackTrans();
					$day_data['error'] = "Could not save a time modified record";
					$day_data['success'] = '';
					$status->message = $day_data;
					return $status;
				}
				log_entry("TimeModified", "ADD", $TimeModified_obj->time_modified_id, $TimeModified_obj);
			}

			$update_TimesheetDay_db = $timesheet->get_update_TimesheetDay_db($type = 'save');
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
			$day_data['success'] = ''; //TODO do all success messages in the model or in class (choose 1)
		}
	} else {
		$day_data = $timesheet->get_reprocessed_day($day_data, $validate = 'TimesheetDay', $success_message = "Saved");
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
	}
	$transaction->commitTrans();
	$status->message = $day_data;
} elseif ($type == "discard_day") {

	$day_data = json_decode($args['json'], true);
	$timesheet->set_day_state($day_data);

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

	$day_data = $timesheet->get_reprocessed_day($day_data, $validate = false, $success_message = "Emptied", $from_db = true);

	$status->message = $day_data;
} elseif ($type == "restore_original_times") {

	$day_data = json_decode($args['json'], true);
	$timesheet->set_day_state($day_data);

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

	$update_TimesheetDay_db = $timesheet->get_update_TimesheetDay_db($type = 'delete');
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

	$day_data = $timesheet->get_reprocessed_day($day_data, $validate = false, $success_message = "Restored original times", $from_db = true);

	$status->message = $day_data;
} elseif ($type == "recalculate") {

	$day_data = json_decode($args['json'], true);
	$day_data = $timesheet->get_reprocessed_day($day_data, $validate = true, $success_message = "Recalculated hours");
	$status->message = $day_data;
} elseif ($type == "cut_overtime") {
	$timesheet->timesheet_period_id = $args['timesheet_period_id'];
	$timesheet->employee_id = $args['employee_id'];
	$up_hours_cut = $args['up_hours_cut'];
	$down_hours_cut = $args['down_hours_cut'];
	
	if (!preg_match("/^((?:1[0-2])|(?:0?[0-9])):([0-5][0-9])(\s)(am|pm)$/", $up_hours_cut) || !preg_match("/^((?:1[0-2])|(?:0?[0-9])):([0-5][0-9])(\s)(am|pm)$/", $up_hours_cut)) {
		$status->error = 'Invalid input';
		return $status;
	}
	
	try {
		$timesheet->init_selectively_from_db($overtime = false, $up_hours_cut, $down_hours_cut);
	} catch (Exception $e) {
		$status->error = $e->getMessage();
		return $status;
	}
	
	$two_weeks_save_array_TimeModified_db = $timesheet->get_two_weeks_save_array_TimeModified_db($only_overtime = true);
//	foreach($two_weeks_save_array_TimeModified_db as $test){
//			print_var($test->toarray(), 1);
//		}
	if(empty($two_weeks_save_array_TimeModified_db)){
		$status->error = "Nothing to trim.  Days that were previously saved are not trimmed.";
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

//	foreach($two_weeks_save_array_TimeModified_db as $test){
//			print_var($test->toarray(), 1);
//		}
}

$status->status = "Success";

return $status;
?>
